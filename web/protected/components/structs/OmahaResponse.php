<?php

class OmahaResponse
{
    public $Protocol;
    public $Server;
    public $AppID;
    public $Status;
    public $DownloadUrl;
    public $Version;
    public $SHA256Hash;
    public $Filename;
    public $SizeBytes;
    public $TraceID;

    private $result_type;

    public function __construct($result_type)
    {
        $this->result_type = $result_type;
        $this->Protocol = "3.0";
        $this->Server = Yii::app()->params['UPDATE_SERVER'];

        $this->AppID = 'None';
        $this->Status = 'ok';
        $this->DownloadUrl = 'None';
        $this->Version = '0.0.0.1';
        $this->SHA256Hash = 'None';
        $this->Filename = 'None';
        $this->SizeBytes = 0;
        $this->TraceID = '';
    }


    /**
     * toXML creates the response XML using string concatenation
     * because XML is nasty in PHP.
     *
     * @return string The object serialized
     */
    public function toXML()
    {
        $result = '';
        if ($this->result_type == OmahaEventResultTypes::NO_UPDATE)
        {
            $result = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<response protocol="$this->Protocol" server="$this->Server">
    <app appid="$this->AppID" status="$this->Status">
        <updatecheck status="noupdate"></updatecheck>
    </app>
</response>
EOT;
        }
        else if ($this->result_type == OmahaEventResultTypes::AVAILABLE)
        {
            $result = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<response protocol="$this->Protocol" server="$this->Server">
    <app appid="$this->AppID" status="$this->Status">
        <updatecheck status="ok">
            <manifest version="$this->Version" trace="$this->TraceID">
                <url codebase="$this->DownloadUrl"></url>
                <package hash="$this->SHA256Hash" name="$this->Filename" size="$this->SizeBytes"></package>
            </manifest>
        </updatecheck>
    </app>
</response>
EOT;
        }

        return $result;
    }

}
