<?php

namespace App\Http\Controllers;

use App\Models\Warrior;
use Exception;
use Illuminate\Http\Request;

class WarriorsController extends Controller
{
    public function doc() {
        return response()->json([
            "Routes" => [
                "GET /api/warriors" => "Show all Warriors.",
                "GET /api/warriors/id" => "Show a specific Warrior.",
                "POST /api/warriors/create" => "Create a Warrior.",
            ],

            "Warriors" => [
                "name" => "Warrior's name, -- min: 4, max: 9",
                "class" => "Warrior's class, -- knight, mage, archer, alchemist, priest",
                "sex" => "Warrior's sex, -- male, female",
                "weapon" => [
                    "knight" => "Sword, Axe",
                    "mage" => "Staff, Wand",
                    "archer" => "Bow, Axe",
                    "alchemist" => "Potion, Mace"
                ]
            ]
        ]);
    }

    public function index() {
        try {
            $allWarriors = Warrior::all();
        } catch (Exception $err) {
            return response()->json(["An error has occurred" => $err]);
        };

        return response()->json($allWarriors);
    }

    public function show($id) {
        try {
            $Warrior = Warrior::find($id, 'id');

            if (!$Warrior) {
                return response()->json(["An error has occurred" => "No Warrior were found with this id."]);
            }

        } catch (Exception $err) {
            return response()->json(["An error has occurred" => $err]);
        };

        return response()->json($Warrior->get());
    }

    public function store(Request $req) {
        try {
            Warrior::create($req->all());

            $warriorCreated = $req->all();
        } catch (Exception $err) {
            return response()->json(["An error has occurred" => $err]);
        };

        return response()->json(["Warrior created!" => $warriorCreated]);
    }
}
