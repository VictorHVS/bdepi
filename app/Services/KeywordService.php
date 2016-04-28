<?php

namespace App\Services;


use App\KeyWord;

class KeywordService
{
    public function save(array $keys)
    {
        $keysID = [];

        foreach ($keys as $key) {
            $keyBD = KeyWord::where("name", "ilike", $key)->first();

            if (!isset($keyBD))
                $keyBD = KeyWord::create(['name' => $key]);

            array_push($keysID, $keyBD->id);
        }
        return $keysID;
    }
}
