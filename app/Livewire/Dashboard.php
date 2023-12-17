<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $memberSavings = [];
    public $lateRemissions = [];
    public $missedMeetings = [];
    public $investments = []; 
    public $chargeSettings = []; 
    public $financialMonths = [];
    public $totalMemberSaving = 0; 
    public $totalLateRemission = 0; 
    public $totalMissedMeeting = 0; 
    public $totalInvestments = 0; 
    public $totalAssets = 0;
    public $totalMembers = 0;
    public $monthlyAmount = 0;
    public $lateRemissionAmount = 0;
    public $missedMeetingAmount = 0;
    public $expMonthSavings = 0;
    
    // Savings months
    public $janSavings = 0; 
    public $febSavings = 0; 
    public $marSavings = 0; 
    public $aprSavings = 0; 
    public $maySavings = 0; 
    public $junSavings = 0;
    public $julSavings = 0; 
    public $augSavings = 0; 
    public $septSavings = 0; 
    public $octSavings = 0; 
    public $novSavings = 0; 
    public $decSavings = 0;
    
    // lateRems months
    public $janLateRems = 0; 
    public $febLateRems = 0; 
    public $marLateRems = 0; 
    public $aprLateRems = 0; 
    public $mayLateRems = 0; 
    public $junLateRems = 0;
    public $julLateRems = 0; 
    public $augLateRems = 0; 
    public $septLateRems = 0; 
    public $octLateRems = 0; 
    public $novLateRems = 0; 
    public $decLateRems = 0;
    public $expJanLateRems = 0; 
    public $expFebLateRems = 0; 
    public $expMarLateRems = 0; 
    public $expAprLateRems = 0; 
    public $expMayLateRems = 0; 
    public $expJunLateRems = 0 ;
    public $expJulLateRems = 0; 
    public $expAugLateRems = 0; 
    public $expSeptLateRems = 0; 
    public $expOctLateRems = 0; 
    public $expNovLateRems = 0; 
    public $expDecLateRems = 0;
    
    // missMeeting months
    public $janMissMeetings = 0;
    public $febMissMeetings = 0;
    public $marMissMeetings = 0;
    public $aprMissMeetings = 0;
    public $mayMissMeetings = 0; 
    public $junMissMeetings = 0;
    public $julMissMeetings = 0;
    public $augMissMeetings = 0;
    public $septMissMeetings = 0;
    public $octMissMeetings = 0;
    public $novMissMeetings = 0;
    public $decMissMeetings = 0;
    public $expMissedMeetings = 0;
    public $expJanMissMeetings = 0;
    public $expFebMissMeetings = 0;
    public $expMarMissMeetings = 0;
    public $expAprMissMeetings = 0;
    public $expMayMissMeetings = 0;
    public $expJunMissMeetings = 0 ;
    public $expJulMissMeetings = 0;
    public $expAugMissMeetings = 0;
    public $expSeptMissMeetings = 0;
    public $expOctMissMeetings = 0;
    public $expNovMissMeetings = 0;
    public $expDecMissMeetings = 0;

    public function render()
    {
        return view('livewire.dashboard');
    }
}
