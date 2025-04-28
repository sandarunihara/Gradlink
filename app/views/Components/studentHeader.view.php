<div class="header-container">
    <div class="header-left">
        <h1 class="header-title"><?php echo isset($title) ? htmlspecialchars($title) : 'Default Title'; ?></h1>
        <?php 
            $round = new Round;
            $currentRoundDetails = $round->getActiveRound();
        ?>
        <div class="header-info-container">
            <!-- Round Badge -->
            <?php if(isset($currentRoundDetails -> roundId) && $currentRoundDetails -> roundId != 3){ ?>
                <div class="round-badge">
                    <span class="round-label">Current Round</span>
                    <span class="round-number"><?php echo isset($currentRoundDetails -> roundId) ? htmlspecialchars($currentRoundDetails -> roundId) : 'N/A'; ?></span>
                </div>
            <?php } ?>
            
            <!-- Remaining Chances Info -->
            <?php if (isset($currentRoundDetails -> roundId)): ?>
                <div class="remaining-info">
                    <?php if ($currentRoundDetails -> roundId): ?>
                        <?php  
                            $arr['StudentId'] = $_SESSION['USER']->StudentId;
                            $student = new student;
                            $temp['Student'] = $student->where($arr, [], '', 'do_not_order')[0];
                            $noOfAppliedAds = $temp['Student']->noOfAppliedAds;

                            $round = new Round;
                            $currentRoundDetails = $round->getActiveRound();
                            $remaining = $currentRoundDetails->vacancy - $noOfAppliedAds;

                            $student_advertisement = new student_advertisement;
                            $advertisement = new C_Advertisement;

                            $slectedRoleDetails = $student_advertisement->where($arr, [], 'CreatedAt', 'asc');
                            $state = 0;
                            if(!empty($slectedRoleDetails)):
                                $advertisementId['AdvertisementId'] = $slectedRoleDetails[0]->AdvertisementId;
                                $selectedPosition = $advertisement->where($advertisementId, [], '', 'do_not_order')[0]->position;
                                foreach($slectedRoleDetails as $slectedRoleDetail):
                                    if($slectedRoleDetail->Jobstatus == 'Recruit'): 
                                        $advertisementId['AdvertisementId'] = $slectedRoleDetail->AdvertisementId;
                                        $selectedJob = $advertisement->where($advertisementId, [], '', 'do_not_order')[0]->position;
                                        $state = 1;
                        ?>
                                    <div class="status-container recruited">
                                        <i class="fas fa-check-circle"></i>
                                        <span class="status-text"><?php echo htmlspecialchars($selectedJob)?></span>
                                    </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if($state != 1): ?>
                                <div class="status-container">
                                    <div class="remaining-applications">
                                        <span class="status-label">Remaining:</span>
                                        <span class="status-value"><?php echo htmlspecialchars($remaining) ?></span>
                                    </div>
                                    <?php if(!empty($slectedRoleDetails)): ?>
                                        <div class="selected-position">
                                            <span class="status-label">Selected:</span>
                                            <span class="status-value"><?php echo htmlspecialchars($selectedPosition)?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                    <?php elseif ($currentRoundDetails -> roundId == 2): ?>
                        <div class="status-container unlimited">
                            <i class="fas fa-infinity"></i>
                            <span class="status-text">Unlimited applications</span>
                        </div>
                    <?php else: ?>
                        <?php 
                            $arr['StudentId'] = $_SESSION['USER']->StudentId;
                            $student_advertisement = new student_advertisement;
                            $slectedRoleDetails = $student_advertisement->where($arr, [], '', 'do_not_order');
                            if(!empty($slectedRoleDetails)):
                                $advertisementId['AdvertisementId'] = $slectedRoleDetails[0]->AdvertisementId;
                                $selectedPosition = $advertisement->where($advertisementId, [], '', 'do_not_order')[0]->position;
                                foreach($slectedRoleDetails as $slectedRoleDetail):
                                    if($slectedRoleDetail->Jobstatus == 'Recruit'): 
                        ?>
                                        <div class="status-container recruited">
                                            <i class="fas fa-check-circle"></i>
                                            <span class="status-text"><?php echo htmlspecialchars($selectedPosition)?></span>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>