<?php

namespace App\Enum;

enum DepartmentType: int
{
    case LawEnforcement = 1;
    case Dispatch = 2;
    case Civilian = 3;
    case FireEMS = 4;
    case OtherInGame = 5;
    case OtherOutGame = 6;
}
