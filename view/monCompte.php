
        <div class="col s12">
            <div class="card">
                <div class="card-content ">
                    <div class="row ">
                        <div class="col s12 m4 center">
                            <img class="avatar" src="./images/avatar.png">
                        </div>
                        <div class="col s12 m8 info center">
                            <div class="card">
                                <div class="card-content black-text">
                                    <span class="card-title"><?php echo  $prenom." ".$nom; ?></span>

                                        <ul>
                                            <li><span class="profile-title">Date de naissance : </span><span class="profile-desc"> <?php echo $date; ?></span></li>
                                            <li><span class="profile-title">Adresse : </span><span class="profile-desc"> <?php echo $adresse; ?></span></li>
                                            <li><span class="profile-title">Email : </span><span class="profile-desc"> <?php echo $email; ?></span></li>
                                            <li><span class="profile-title">Téléphone : </span><span class="profile-desc"> <?php echo $telephone; ?></span></li>
                                        </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>