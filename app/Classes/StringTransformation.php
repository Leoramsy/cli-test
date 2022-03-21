<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;
use League\Csv\EncloseField;

class StringTransformation
{
    protected string $string;

    public function __construct(string $string)
    {
        $this->string = $string;
    }

    /**
     * @return string
     */
    public function getString(): string
    {
        return $this->string;
    }

    public function getUpperCase() :string
    {
        return strtoupper($this->string);
    }

    public function getAlternateCase() :string
    {
        $convertedString = '';
        foreach(str_split($this->string) AS $key => $character){
            $convertedString .= ($key%2==0 ? strtolower($character): strtoupper($character));
        }
        return $convertedString;
    }

    /**
     * @throws \League\Csv\CannotInsertRecord
     * @throws \League\Csv\Exception
     */
    public function outputCsv() :bool
    {
        try {
            $filePath = $this->string . '.csv';
            Storage::disk('root')->put($filePath, '');
            $csv = Writer::createFromPath(base_path() . '/' . $filePath);
            $csv->setNewline("\r\n");
            EncloseField::addTo($csv, "\n\r\t");
            $csv->insertOne(mb_str_split($this->string));
            return Storage::disk('root')->exists($filePath);
        } catch(\Exception $exception){
            return false;
        }

    }
}
