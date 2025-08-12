<?php

namespace App\Enum;

enum CallNatures: string
{
    case ABDUCTIO = 'ABDUCTIO';
    case ABUSEABA = 'ABUSEABA';
    case ACCPRT = 'ACCPRT';
    case ACCPD = 'ACCPD';
    case ALARM = 'ALARM';
    case ANIMAL = 'ANIMAL';
    case ASSLTIP = 'ASSLTIP';
    case ASSAULT_REPORT = 'ASSAULT_REPORT';
    case ASSLTSEX = 'ASSLTSEX';
    case ASSLTIJ = 'ASSLTIJ';
    case ATL = 'ATL';
    case BOMBEXP = 'BOMBEXP';
    case BOMBFND = 'BOMBFND';
    case BOMBTHRT = 'BOMBTHRT';
    case BURGLARY = 'BURGLARY';
    case BURGIP = 'BURGIP';
    case BURG = 'BURG';
    case CARJACK = 'CARJACK';
    case CONTSUBS = 'CONTSUBS';
    case DECEASED = 'DECEASED';
    case DIST = 'DIST';
    case DISTDOME = 'DISTDOME';
    case DISTNOIS = 'DISTNOIS';
    case DISTURBN = 'DISTURBN';
    case DISTWEAP = 'DISTWEAP';
    case DOMESTIC = 'DOMESTIC';
    case DUI = 'DUI';
    case FBRUSH = 'FBRUSH';
    case FCOALARM = 'FCOALARM';
    case FCONFINE = 'FCONFINE';
    case FEXTRIC = 'FEXTRIC';
    case FHAZMAT = 'FHAZMAT';
    case FIGHT = 'FIGHT';
    case FIGHTWEA = 'FIGHTWEA';
    case FNDPERS = 'FNDPERS';
    case FNDPROP = 'FNDPROP';
    case FNONSTR = 'FNONSTR';
    case FSTRUCT = 'FSTRUCT';
    case GUNSHOTS = 'GUNSHOTS';
    case HARASSME = 'HARASSME';
    case HITRUN = 'HITRUN';
    case HITRUNIJ = 'HITRUNIJ';
    case HOMICID = 'HOMICID';
    case HOSTAGE = 'HOSTAGE';
    case INDECENC = 'INDECENC';
    case INDEXP = 'INDEXP';
    case INTOXDRV = 'INTOXDRV';
    case INTOXPER = 'INTOXPER';
    case JUVENILE = 'JUVENILE';
    case KIDNAPIP = 'KIDNAPIP';
    case KIDNAP = 'KIDNAP';
    case MEDI = 'MEDI';
    case MISCELLA = 'MISCELLA';
    case MISSINGF = 'MISSINGF';
    case NCORDER = 'NCORDER';
    case OTHER = 'OTHER';
    case OUTSIDEF = 'OUTSIDEF';
    case PICKUP = 'PICKUP';
    case PURSUITF = 'PURSUITF';
    case PURSUITV = 'PURSUITV';
    case RECKLESS = 'RECKLESS';
    case RECOVERY = 'RECOVERY';
    case ROBBERYC = 'ROBBERYC';
    case ROBERYIP = 'ROBERYIP';
    case ROBBERY = 'ROBBERY';
    case RUNAWAY = 'RUNAWAY';
    case SHOOTING = 'SHOOTING';
    case SRT = 'SRT';
    case STABBING = 'STABBING';
    case STALLVEH = 'STALLVEH';
    case SUBJWEAP = 'SUBJWEAP';
    case SUSPPKGB = 'SUSPPKGB';
    case SUSPPERS = 'SUSPPERS';
    case SUSPVEH = 'SUSPVEH';
    case SUSPICIO = 'SUSPICIO';
    case THEFT = 'THEFT';
    case THEFTFRV = 'THEFTFRV';
    case THEFTIC = 'THEFTIC';
    case THEFTIP = 'THEFTIP';
    case THEFTVEH = 'THEFTVEH';
    case TRAFFTOW = 'TRAFFTOW';
    case TRAFFIC = 'TRAFFIC';
    case TRAFFHAZ = 'TRAFFHAZ';
    case TS = 'TS';
    case TRAFFICA = 'TRAFFICA';
    case TRAFFICV = 'TRAFFICV';
    case TRESPASS = 'TRESPASS';
    case TRBLUNK = 'TRBLUNK';
    case VEHICLEF = 'VEHICLEF';
    case WATERRES = 'WATERRES';
    case WATERCRA = 'WATERCRA';
    case WELFCHK = 'WELFCHK';
    case TEST = 'TEST';

    public static function options(): array
    {
        // Returns ['ABDUCTIO' => 'ABDUCTION', 'ABUSEABA' => 'ABUSE ABANDONMENT NEGLECT', ...]
        return array_combine(
            array_map(fn (self $case) => $case->value, self::cases()),
            array_map(fn (self $case) => $case->label(), self::cases())
        );
    }

    public function label(): string
    {
        return match ($this) {
            self::ABDUCTIO => 'ABDUCTION',
            self::ABUSEABA => 'ABUSE ABANDONMENT NEGLECT',
            self::ACCPRT => 'ACCIDENT (REPORT ONLY)',
            self::ACCPD => 'ACCIDENT PD',
            self::ALARM => 'ALARM COMPANY - POLICE',
            self::ANIMAL => 'ANIMAL PROBLEM',
            self::ASSLTIP => 'ASSAULT IN PROGRESS',
            self::ASSAULT_REPORT => 'ASSAULT REPORT',
            self::ASSLTSEX => 'ASSAULT SEXUAL',
            self::ASSLTIJ => 'ASSAULT WITH INJURY (NOT IN PROGRESS)',
            self::ATL => 'ATTEMPT TO LOCATE',
            self::BOMBEXP => 'BOMB EXPLOSION',
            self::BOMBFND => 'BOMB FOUND',
            self::BOMBTHRT => 'BOMB THREAT',
            self::BURGLARY => 'BURGLARY HOME INVASION',
            self::BURGIP => 'BURGLARY IN PROGRESS',
            self::BURG => 'BURGLARY REPORT',
            self::CARJACK => 'CAR JACKING',
            self::CONTSUBS => 'CONTROLLED SUBSTANCE',
            self::DECEASED => 'DECEASED PERSON',
            self::DIST => 'DISTURBANCE',
            self::DISTDOME => 'DISTURBANCE - DOMESTIC',
            self::DISTNOIS => 'DISTURBANCE - NOISE',
            self::DISTURBN => 'DISTURBANCE NUISANCE',
            self::DISTWEAP => 'DISTURBANCE W/WEAPON',
            self::DOMESTIC => 'DOMESTIC DISTURBANCE VIOLENCE',
            self::DUI => 'DRIVING UNDER THE INFLUENCE (IMPAIRED DRIVING)',
            self::FBRUSH => 'GRASS, BRUSH, or OR TIMBER FIRE',
            self::FCOALARM => 'CARBON MONOXIDE ALARM',
            self::FCONFINE => 'CONFINED SPACE RESCUE',
            self::FEXTRIC => 'EXTRICATION',
            self::FHAZMAT => 'HAZ-MAT',
            self::FIGHT => 'FIGHT',
            self::FIGHTWEA => 'FIGHT W/WEAPON',
            self::FNDPERS => 'FOUND PERSON',
            self::FNDPROP => 'FOUND PROPERTY',
            self::FNONSTR => 'NON-STRUCTURE FIRE',
            self::FSTRUCT => 'STRUCTURE FIRE',
            self::GUNSHOTS => 'GUNSHOTS REPORTED',
            self::HARASSME => 'HARASSMENT STALKING THREAT',
            self::HITRUN => 'HIT & RUN',
            self::HITRUNIJ => 'HIT & RUN WITH INJURY',
            self::HOMICID => 'HOMICIDE',
            self::HOSTAGE => 'HOSTAGE',
            self::INDECENC => 'INDECENCY LEWDNESS',
            self::INDEXP => 'INDECENT EXPOSURE',
            self::INTOXDRV => 'INTOXICATED DRIVER',
            self::INTOXPER => 'INTOXICATED PERSON',
            self::JUVENILE => 'JUVENILE TROUBLE',
            self::KIDNAPIP => 'KIDNAPPING IN PROGRESS',
            self::KIDNAP => 'KIDNAPPING REPORT',
            self::MEDI => 'MEDICAL',
            self::MISCELLA => 'MISCELLANEOUS',
            self::MISSINGF => 'MISSING RUNAWAY FOUND PERSON',
            self::NCORDER => 'NO CONTACT ORDER VIOLATION',
            self::OTHER => 'OTHER',
            self::OUTSIDEF => 'OUTSIDE FIRE',
            self::PICKUP => 'PICKUP ITEM/PROPERTY',
            self::PURSUITF => 'FOOT PURSUIT',
            self::PURSUITV => 'VEHICLE PURSUIT',
            self::RECKLESS => 'RECKLESS DRIVER',
            self::RECOVERY => 'RECOVERY STOLEN VEHICLE',
            self::ROBBERYC => 'ROBBERY CARJACKING',
            self::ROBERYIP => 'ROBBERY IN PROGRESS',
            self::ROBBERY => 'ROBBERY REPORT',
            self::RUNAWAY => 'RUNAWAY',
            self::SHOOTING => 'SHOOTING',
            self::SRT => 'SRT CALL',
            self::STABBING => 'STABBING',
            self::STALLVEH => 'STALLED VEHICLE',
            self::SUBJWEAP => 'SUBJECT WITH A WEAPON',
            self::SUSPPKGB => 'SUSPICIOUS PACKAGE/BOMB THREAT',
            self::SUSPPERS => 'SUSPICIOUS PERSON',
            self::SUSPVEH => 'SUSPICIOUS VEHICLE',
            self::SUSPICIO => 'SUSPICIOUS WANTED PERSON CIRCUMSTANCES VEHICLE',
            self::THEFT => 'THEFT',
            self::THEFTFRV => 'THEFT FROM VEHICLE',
            self::THEFTIC => 'THEFT IN CUSTODY',
            self::THEFTIP => 'THEFT IN PROGRESS',
            self::THEFTVEH => 'THEFT OF VEHICLE',
            self::TRAFFTOW => 'TOW VEHICLE',
            self::TRAFFIC => 'TRAFFIC',
            self::TRAFFHAZ => 'TRAFFIC HAZARD',
            self::TS => 'TRAFFIC STOP',
            self::TRAFFICA => 'TRAFFIC TRANSPORTATION ACCIDENT (CRASH)',
            self::TRAFFICV => 'TRAFFIC VIOLATION',
            self::TRESPASS => 'TRESPASSING UNWANTED',
            self::TRBLUNK => 'TROUBLE UNKNOWN',
            self::VEHICLEF => 'VEHICLE FIRE',
            self::WATERRES => 'WATER RESCUE',
            self::WATERCRA => 'WATERCRAFT IN DISTRESS',
            self::WELFCHK => 'WELFARE CHECK',
            self::TEST => 'TEST CALL',
        };
    }

    public function code(): string
    {
        return $this->name;
    }
}
