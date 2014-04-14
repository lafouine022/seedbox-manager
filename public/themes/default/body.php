    <!-- CONTENEUR -->
    <div class="container marg">
        <h1 class="icone-seed-managerdashboard page-header dashboard">Tableau de bord</h1>
        <noscript>
            <div class="alert alert-info">
                <h4>Information</h4>
                Javascript n'est pas activé ou quelque chose empêche sa bonne exécution sur votre navigateur web.<br>
                Pour pouvoir utiliser cette interface l'activation de javascript est nécessaire.
            </div>
        </noscript>
    
    <?php if ( isset($_POST['reboot']) && $rebootRtorrent['statusReboot'] == 0 ) { ?>

        <div class="alert alert-success">Votre session rtorrent a été redémarré avec succès.</div>

    <?php } elseif ( isset($_POST['reboot']) && $rebootRtorrent['statusReboot'] != 0 ) { ?>
        
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Un problème est survenu lors du redémarrage de rtorrent</strong>, vérifiez votre configuration.
        </div>

    <?php } if ( isset($_POST['reboot']) && $rebootRtorrent['statusReboot'] == 0 ) { ?>

        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Log :</strong><br>
            <?php

                echo 'commande exécuté : '.$current_path.'/reboot-rtorrent '.$userName.'<br>';
                echo 'status : '.$rebootRtorrent['statusReboot'].'<br>';
                echo 'résultat de la commande :<br>';
                $i=0;
                while( $i < count( $rebootRtorrent['logReboot'] ) )
                {
                    echo ' $ '.$rebootRtorrent['logReboot'][$i].'<br>';
                    $i++;
                }
            ?>
        </div>

    <?php } if ( isset($_POST['support']) && $supportInfo['file_exist'] === true) {?>
        <div class="alert alert-success">Votre ticket a était envoyé.</div>
    <?php } if ( isset($_POST['cloture']) && $cloture === true) {?>
        <div class="alert alert-success">Ticket a était fermé.</div>
   <?php } if ( isset($_POST['cloture']) && $cloture === false ) {?>
        <div class="alert alert-info">Erreur de fermeture</div>
   <?php }?>
    <section class="row">

        <?php if ( $user->blocInfo() === true ) { ?>
        <article class="col-md-6">
            <div class="well well-sm">
                <h4 class="titre-head icone-seed-managerhome">Information compte utilisateur</h4>
                <div class="trait"></div>

                <p class="icone-seed-managerlocation"><strong>Votre adresse Ip</strong></p>
                <ul>
                    <li><strong class="text-success"><?php echo $_SERVER['REMOTE_ADDR']; ?></strong></li>
                </ul>
                <p class="icone-seed-managerstorage"><strong>Espace disque</strong></p>
                <p class="text-center text-defaut-color">Vous utilisez <strong><?php echo $data_disk['percentage_used']; ?>%</strong> <em>soit <?php echo $data_disk['used_disk']; ?> sur <?php echo $data_disk['total_disk']; ?></em></p>

                <div class="progress progress-striped fix-progress">
                    <div class="progress-bar <?php echo $data_disk['progessBarColor']; ?>" role="progressbar" aria-valuenow="<?php echo $data_disk['percentage_used']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $data_disk['percentage_used']; ?>%;">
                        <span class="sr-only"><?php echo $data_disk['percentage_used']; ?>% Complete</span>
                    </div>
                </div>

                <p class="icone-seed-managerclock"><strong>Uptime serveur</strong></p>
                <ul>
                    <li><strong class="text-success"><?php echo Server::getUptime(); ?></strong></li>
                </ul>

                <p class="icone-seed-managerstats"><strong>Charge serveur</strong></p>
                <ul>
                    <li style="cursor:default;">
                        <span class="text-defaut-color">load average : </span>
                        <span data-original-title="Charge moyenne depuis 1 min" class="label label-primary load-average"><?php echo $load_server['load_average'][0]; ?></span>
                        <span data-original-title="Charge moyenne depuis 5 min" class="label label-primary load-average"><?php echo $load_server['load_average'][1]; ?></span>
                        <span data-original-title="Charge moyenne depuis 15 min" class="label label-primary load-average"><?php echo $load_server['load_average'][2]; ?></span>
                    </li>
                    <li id="load-info"><?php echo $load_server['info_charge']; ?></li>
                </ul>
            </div>
        </article>

        <?php } if ( $user->blocFtp() === true ) { ?>
        <article class="col-md-6">
            <div class="well well-sm">
                <h4 class="icone-seed-managertree titre-head">Les accès ftp / sftp / transdroid</h4>
                <div class="trait"></div>

                <h5 class="icone-seed-managerlaptop"><strong>Serveur FTP et sFTP</strong></h5>
                <ul>
                    <li>Adresse (s)FTP : <em>(s)ftp://<?php echo $host; ?></em></li>
                    <li>User (s)FTP : <em><?php echo $userName; ?></em></li>
                    <li>Port FTP : <em><?php echo $user->portFtp(); ?></em></li>
                    <li>Port sFTP : <em><?php echo $user->portSftp(); ?></em></li>
                    <li><a class="btn btn-info btn-xs icone-seed-managerdownload" href="http://filezilla.fr/">Télécharger filezilla</a></li>
                    <li><a id="popupfilezilla" class="btn btn-info btn-xs icone-seed-managerfile-xml" data-toggle="popover" href="?download&amp;file=filezilla">Fichier de configuration</a></li>
                </ul>

                <h5 class="icone-seed-managerandroid"><strong>Application Transdroid</strong></h5>
                <ul>
                    <li>Dossier SCGI : <em><strong><?php echo $user->scgi_folder; ?></strong></em></li>
                    <li>Adresse http : <em>http://<?php echo $host; ?></em></li>
                    <li>User transdroid : <em><?php echo $userName; ?></em></li>
                    <li><a class="btn btn-info btn-xs icone-seed-managerdownload" href="http://transdroid.org/latest">Télécharger Transdroid</a></li>
                    <li><a id="popuptransdroid" class="btn btn-info btn-xs icone-seed-managerfile-xml" data-toggle="popover" href="?download&amp;file=transdroid">Fichier de configuration</a></li>
                </ul>
            </div>
        </article>
        <?php } if ( $user->blocRtorrent() === true ) { ?>

        <article class="col-md-6">
            <div class="well well-sm">
                <h4 class="titre-head icone-seed-managerlightning">Gestion de rtorrent</h4>
                <div class="trait"></div>
                <p class="text-center btn-reboot">
                    <a data-toggle="modal" href="#popupreboot" class="btn btn-info btn-lg" style="vertical-align: middle;"><span class="glyphicon glyphicon-refresh"></span>Redémarrer rtorrent</a>
                </p>
                <?php if ( $read_data_reboot['file_exist'] ) { ?>
                <small class="text-defaut-color"><em>Dernier redémarrage le <?php echo $read_data_reboot['read_file']; ?></em></small>
                <?php } ?>
            </div>
        </article>

        <?php } if ( $user->blocSupport() === true ) { ?>
        <article class="col-md-6">
            <div class="well well-sm">
                <h4 class="icone-seed-managersupport titre-head">Contacter le Support</h4>
                <div class="trait"></div>

                <?php if ( $user->is_owner() === true) {  ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Utilisateur</th>
                                        <th>Status</th>
                                        <th>Créé le</th>
                                        <th>Màj</th>
                                        <th>Fermer/Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                <?php
                            $list = $support->ticketList();
                            
                            if (!empty($list)) //Vérification de l'exitence d'un ticket. 
                            {
                                foreach ($list as $i => $ticket)
                                {   
                                    $etat = $support->etatTicket($ticket); //Ticket ouvert ou fermé
                                    $json = $support->decodeJson($ticket); // Decode du json
                                    $nbTicket = count($json);
                                    $userSupport = $json[0]['datas']['user']; // Nom de la personne qui a ouvert du ticket
                                    $ouvertureDate = $json[0]['datas']['date']; // Date d'ouverture
                                    $dateModif = $json[(count($json)-1)]['datas']['date']; // //Date de derniere modification (Dernier message envoier)
                                    $supp = array('./conf/users/','/support.json'); //chaine a supprimer
                ?> 
                                    <tr> 
                                        <td>
                                            <button class="btn <?php if ($etat === false) {echo 'btn-danger';} else  {echo 'btn-success';}?>" data-toggle="collapse" data-target="#bouton_<?php echo $i ?>"><?php echo $i ?></button>
                                        </td> 
                <?php                                                                                      
                                        echo "<td>".$userSupport."</td>";
                                        if ( $etat === false )
                                        {
                                            echo "<td>Ouvert</td>";
                                        } else echo "<td>Fermer</td>";

                                        echo "<td>".$ouvertureDate."</td>"; 
                                        echo "<td>".$dateModif."</td>"; 
                                        if ( $etat === false )
                                        {
                                            echo '<form method="post" action="">';
                                            echo '<input type="hidden" name="user" value="'.str_replace($supp, "", $ticket).'" class="btn btn-info">';
                                            echo '<td><input type="submit" name="cloture" value="Fermer le Ticket" class="btn btn-info">';
                                            echo '</form>';                                       
                                        }
                                        echo '</tr>';
                                    echo '<div id="bouton_'.$i.'" class="collapse">';

                                    // affichage des messages
            
                                    echo '<div class="panel panel-default">';
                                    
                                    $j=0;
                                    while ($j != $nbTicket)
                                    {
                                        if ($userName != $userSupport)                                             
                                            echo '<div class="panel-heading">Message de '.$json[$j]['datas']['user']; 

                                        else  
                                            echo '<div class="panel-heading">Votre message';

                                        echo ' - le '.$json[$j]['datas']['date'].'</div>';
                                        echo '<div class="panel-body">' . nl2br($json[$j]['datas']['message']) . '</div>';
                                        $j++;
                                    }
                                    echo '</div>';
                                    if ($etat===false) {
                ?>
                                        <form method="post" action="index.php">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <label for="support">Répondre</label>
                                                        <textarea class="form-control" name="message" rows="3"></textarea>
                                                    </div>
                                                </fieldset>
                                                <p class="text-right fix-marg-input">
                                                    <input type="hidden" name="user" value="<?php echo $userSupport; ?>" class="btn btn-info">
                                                    <input type="submit" name="support" value="Repondre au Ticket" class="btn btn-info">                            
                                                </p>
                                            </form>
                <?php
                                    }
                                }
                            }                                                                        
                            else { ?>
                                <div class="panel panel-default"><div class="panel-body">Il n'y a pas de message.</div></div>
                            <?php } ?>
                            </tbody></table>
                <?php   } 
                        else 
                        { 
                            $list = $support->ticketList();
                            

                            if (!empty($list)) {
                                foreach ($list as $i => $ticket)
                                {   
                                    $etat = $support->etatTicket($ticket);
                                    if ($etat == false){
                                        
                                        $json = $support->decodeJson($ticket); // Decode du json
                                        $nbTicket = count($json);
                                        $userSupport = $json[0]['datas']['user'];
                                        echo '<div class="panel panel-default">';
                                    
                                    
                                        $j=0;
                                        while ($j != $nbTicket)
                                        {
                                            if ($userName != $userSupport)                                             
                                                echo '<div class="panel-heading">Message de '.$json[$j]['datas']['user']; 

                                            else  
                                                echo '<div class="panel-heading">Votre message';

                                            echo ' - le '.$json[$j]['datas']['date'].'</div>';
                                            echo '<div class="panel-body">'.nl2br($json[$j]['datas']['message']).'</div>';
                                            $j++;
                                        }
                                        echo '</div>';
                                    }
                                }
                            }
                ?>
                            <form method="post" action="index.php">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="support">Message du ticket</label>
                                        <textarea class="form-control" name="message" rows="3"></textarea>                                    
                                    </div>
                                </fieldset>
                            
                                <p class="text-right fix-marg-input"> 
                                    <input type="hidden" name="user" value="<?php echo $userName; ?>" class="btn btn-info">
                                    <input type="submit" name="support" value="Envoyer un Ticket" class="btn btn-info">                            
                                </p>                        
                            </form>
                <?php   } ?>
                <address>
                    <strong>Adresse mail :</strong>
                    <?php echo '<a href="mailto:'.$user->supportMail().'" target="_blank">'.$user->supportMail().'</a>'; ?>
                </address>
            </div>
        </article>

        <?php } ?>

    </section>
    </div><!-- FIN DIV CONTENEUR -->