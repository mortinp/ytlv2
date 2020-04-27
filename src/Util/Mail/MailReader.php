<?php

//require_once('mimeDecode.php');
namespace App\Util\Mail;

use App\Util\Mail\MailMimeDecode;

/*
 * @class mailReader.php
 *
 * @brief Recieve mail and attachments with PHP
 *
 * Support: 
 * http://stuporglue.org/mailreader-php-parse-e-mail-and-save-attachments-php-version-2/
 *
 * Code:
 * https://github.com/stuporglue/mailreader
 *
 * See the README.md for the license, and other information
 */
class MailReader {
    var $attachments = Array();
    //var $send_email = FALSE; // Send confirmation e-mail back to sender?
    //var $save_msg_to_db = FALSE; // Save e-mail message and file list to DB?
    //var $save_directory; // A safe place for files. Malicious users could upload a php or executable file, so keep this out of your web root
    //var $allowed_senders = Array(); // Allowed senders is just the email part of the sender (no name part)
    var $allowed_mime_types = Array(
        'audio/wave',
        'application/pdf',
        'application/zip',
        'application/octet-stream',
        'image/jpeg',
        'image/png',
        'image/gif',
    );
    var $debug = FALSE;

    var $raw = '';
    var $decoded;
    var $from;
    var $to;
    var $subject;
    var $body;


    /**
     * @param $save_directory (required) A path to a directory where files will be saved
     * @param $allowed_senders (required) An array of email addresses allowed to send through this script
     * @param $pdo (optional) A PDO connection to a database for saving emails 
     */
    public function __construct(/*$save_directory,$allowed_senders,$pdo = NULL*/){
        /*if(!preg_match('|/$|',$save_directory)){ $save_directory .= '/'; } // add trailing slash if needed
            $this->save_directory = $save_directory;
        $this->allowed_senders = $allowed_senders;
        $this->pdo = $pdo;*/
    }

    /**
     * @brief Read an email message
     *
     * @param $src (optional) Which file to read the email from. Default is php://stdin for use as a pipe email handler
     *
     * @return An associative array of files saved. The key is the file name, the value is an associative array with size and mime type as keys.
     */
    public function readEmail($raw){
        
        $this->raw = $raw;

        // Now decode it!
        // http://pear.php.net/manual/en/package.mail.mail-mimedecode.decode.php
        $decoder = new MailMimeDecode($this->raw);
        $this->decoded = $decoder->decode(
            Array(
                'decode_headers' => TRUE,
                'include_bodies' => TRUE,
                'decode_bodies' => TRUE,
            )
        );

        // Set $this->from_email and check if it's allowed
        $this->from = $this->decoded->headers['from'];
        $this->from_email = preg_replace('/.*<(.*)>.*/',"$1",$this->from);
        /*if(!empty($allowed_senders) && !in_array($this->from_email,$this->allowed_senders)){
            die("$this->from_email not an allowed sender");
        }*/
		
            // Set the $this->to
        $this->to = $this->decoded->headers['to'];

        // Set the $this->subject
        $this->subject = $this->decoded->headers['subject'];

        // Find the email body, and any attachments
        // $body_part->ctype_primary and $body_part->ctype_secondary make up the mime type eg. text/plain or text/html
        if(isset($this->decoded->parts) && is_array($this->decoded->parts)){
            foreach($this->decoded->parts as $idx => $body_part){
                //print_r($body_part);
                $this->decodePart($body_part);
            }
        }

        if(isset($this->decoded->disposition) && $this->decoded->disposition == 'inline'){
            $mimeType = "{$this->decoded->ctype_primary}/{$this->decoded->ctype_secondary}"; 

            if(isset($this->decoded->d_parameters) &&  array_key_exists('filename',$this->decoded->d_parameters)){
                $filename = $this->decoded->d_parameters['filename'];
            }else{
                $filename = 'file';
            }

            // MARTIN: No hace falta este adjunto ya...
            //$this->addAttachment($filename,$this->decoded->body,$mimeType);
            
            $this->body = $this->decoded->body;
            
            // MARTIN: Como ya no pongo el adjunto, no hace falta poner esto de abajo...
            /*$this->body .= '<br/><br/>';
            $this->body .= '<em>';
            $this->body .= "Este correo contenía un texto binario. Si el texto no se ve bien, revise el adjunto <b>$filename</b>".'<br/>'.
                           "This email contained a binary text. If the text doesn't show properly, see the attachment <b>$filename</b>";
            $this->body .= '</em>';*/
        }

        // We might also have uuencoded files. Check for those.
        if(!isset($this->body)){
            if(isset($this->decoded->body)){
                $this->body = $this->decoded->body;
            }else{
                $this->body = '<em>';
                $this->body .= 'Este correo no contenía ningún texto<br/>'.
                               'This email did not have any text';
                $this->body .= '</em>';
                
                //$this->body = "No plain text body found";
            }
        }

        if(preg_match("/begin ([0-7]{3}) (.+)\r?\n(.+)\r?\nend/Us", $this->body) > 0){
            foreach($decoder->uudecode($this->body) as $file){
                // file = Array('filename' => $filename, 'fileperm' => $fileperm, 'filedata' => $filedata)
                $this->addAttachment($file['filename'],$file['filedata']);
            }
            // Strip out all the uuencoded attachments from the body
            while(preg_match("/begin ([0-7]{3}) (.+)\r?\n(.+)\r?\nend/Us", $this->body) > 0){
                $this->body = preg_replace("/begin ([0-7]{3}) (.+)\r?\n(.+)\r?\nend/Us", "\n",$this->body);
            }
        }


        /*// Put the results in the database if needed
        if($this->save_msg_to_db && !is_null($this->pdo)){
            $this->saveToDb();
        }*/

        /*// Send response e-mail if needed
        if($this->send_email && $this->from_email != ""){
            $this->sendEmail();
        }*/

        // Print messages
        if($this->debug){
            $this->debugMsg();
        }

        return $this->attachments;
    }

    /**
     * @brief Decode a single body part of an email message
     *
     * @note Recursive if nested body parts are found
     *
     * @note This is the meat of the script.
     *
     * @param $body_part (required) The body part of the email message, as parsed by MailMimeDecode
     */
    private function decodePart($body_part){
        $lookupKey = array_key_exists('d_parameters',$body_part)? $body_part->d_parameters:$body_part->ctype_parameters;
	
        if(array_key_exists('name',$lookupKey)){ // everyone else I've tried
            $filename = $lookupKey['name'];
        }else if($lookupKey && array_key_exists('filename',$lookupKey)){ // hotmail
            $filename = $lookupKey['filename'];
        }else{
            $filename = "file";
        }

        $mimeType = "{$body_part->ctype_primary}/{$body_part->ctype_secondary}"; 

        if($this->debug){
            print "Found body part type $mimeType\n";
        }

        if($body_part->ctype_primary == 'multipart') {
            if(is_array($body_part->parts)){
                foreach($body_part->parts as $ix => $sub_part){
                    $this->decodePart($sub_part);
                }
            }
        } else if($mimeType == 'text/plain'){
            if(!isset($body_part->disposition)){
                $this->body .= $body_part->body . "\n"; // Gather all plain/text which doesn't have an inline or attachment disposition
            } else if($body_part->disposition == 'attachment') {
                $this->addAttachment($filename,$body_part->body,$mimeType);
            }
        } else if(in_array($mimeType,$this->allowed_mime_types)){
            $this->addAttachment($filename,$body_part->body,$mimeType);
        }
    }

    /**
     * @brief Save off a single file
     *
     * @param $filename (required) The filename to use for this file
     * @param $contents (required) The contents of the file we will save
     * @param $mimeType (required) The mime-type of the file
     */
    private function addAttachment($filename,$contents,$mimeType = 'unknown'){       
        /*$unique_filename = preg_replace('/[^a-zA-Z0-9_-]/','_',$filename);

        $unlocked_and_unique = FALSE;
        while(!$unlocked_and_unique){
            // Find unique
            $name = time() . "_" . $unique_filename;
            while(file_exists($this->save_directory . $name)) {
                $name = time() . "_" . $unique_filename;
            }

            // Attempt to lock
            $outfile = fopen($this->save_directory.$name,'w');
            if(flock($outfile,LOCK_EX)){
                $unlocked_and_unique = TRUE;
            }else{
                flock($outfile,LOCK_UN);
                fclose($outfile);
            }
        }

        fwrite($outfile,$contents);
        fclose($outfile);*/

        // This is for readability for the return e-mail and in the DB
        $this->attachments[$filename] = Array(
            'contents'=>$contents,
            //'size' => $this->formatBytes(filesize($this->save_directory.$name)),
            'mimetype' => $mimeType
        );
    }

    /**
     * @brief Format Bytes into human-friendly sizes
     *
     * @return A string with the number of bytes in the largest applicable unit (eg. KB, MB, GB, TB)
     */
    private function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    } 

    /**
     * @brief Save the plain text, subject and sender of an email to the database
     */
    /*private function saveToDb(){
        $insert = $this->pdo->prepare("INSERT INTO emails (fromaddr,subject,body) VALUES (?,?,?)");

        // Replace non UTF-8 characters with their UTF-8 equivalent, or drop them
        if(!$insert->execute(Array(
            mb_convert_encoding($this->from_email,'UTF-8','UTF-8'),
            mb_convert_encoding($this->subject,'UTF-8','UTF-8'),
            mb_convert_encoding($this->body,'UTF-8','UTF-8')
        ))){
            if($this->debug){
                print_r($insert->errorInfo());
            }
            die("INSERT INTO emails failed!");
        }
        $email_id = $this->pdo->lastInsertId();

        foreach($this->attachments as $f => $data){
            $insertFile = $this->pdo->prepare("INSERT INTO files (email_id,filename,mailsize,mime) VALUES (:email_id,:filename,:size,:mime)");
            $insertFile->bindParam(':email_id',$email_id);
            $insertFile->bindParam(':filename',mb_convert_encoding($f,'UTF-8','UTF-8'));
            $insertFile->bindParam(':size',$data['size']);
            $insertFile->bindParam(':mime',$data['mime']);
            if(!$insertFile->execute()){
                if($this->debug){
                    print_r($insertFile->errorInfo());
                }
                die("Insert file info failed!");
            }
        }
    }*/

    /**
     * @brief Send the sender a response email with a summary of what was saved
     */
    /*private function sendEmail(){
        $newmsg = "Thanks! I just uploaded the following ";
        $newmsg .= "files to your storage:\n\n";
        $newmsg .= "Filename -- Size\n";
        foreach($this->attachments as $f => $s){
            $newmsg .= "$f -- ({$s['size']}) of type {$s['mime']}\n";
        }
        $newmsg .= "\nI hope everything looks right. If not,";
        $newmsg .=  "please send me an e-mail!\n";

        mail($this->from_email,$this->subject,$newmsg);
    }*/

    /**
     * @brief Print a summary of the most recent email read
     */
    private function debugMsg(){
        print "From : $this->from_email\n";
		print "To : $this->to\n";
        print "Subject : $this->subject\n";
        print "Body : $this->body\n";
        print "Saved Files : \n";
        print_r($this->attachments);
    }
}
