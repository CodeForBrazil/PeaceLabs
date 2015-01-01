<?php
$app_name = "Lets";
$contact_admin = "Si le problème se répète, veuillez nous contacter: %s";
$site_url = site_url('');

$lang['app_site_name'] = "Lets - Pour de vrai";
$lang['app_home'] = "Accueil";

/**** Génériques */
$lang['app_apply'] = "Lets";
$lang['app_disclaim'] = '<span class="disclaim">Lets</span>';
$lang['app_close'] = "Fermer";
$lang['app_cancel'] = "Annuler";
$lang['app_connect'] = "Se connecter";
$lang['app_disconnect'] = "Se déconnecter";
$lang['app_register'] = "S'inscrire";
$lang['app_already_account'] = "Déjà un compte?";
$lang['app_my_account'] = "Mon profil et mes activités";
$lang['app_retrieve_password'] = "Mot de passe oublié?";
$lang['app_save'] = "Enregistrer";
$lang['app_send'] = "Envoyer";
$lang['app_remove'] = "Retirer";
$lang['app_delete'] = "Supprimer";
$lang['app_browse'] = "Choisir une image";
$lang['app_parameters'] = "Informations du compte";
$lang['app_yes'] = "Oui";
$lang['app_no'] = "Non";
$lang['app_back_to_profile'] = "Retour au profil";

/**** Globals */
$lang['app_activity'] = "Activité";
$lang['app_activities'] = "Activités";

/**** Modals */
$lang['app_login_title'] = "Se connecter à $app_name";
$lang['app_register_title'] = "Créer un nouveau compte $app_name";
$lang['app_password_title'] = "Récupération du mot de passe";
$lang['app_new_activity_title'] = "Ajouter une activité";

/**** Form labels */
$lang['app_name'] = "Nom";
$lang['app_avatar'] = "Image";
$lang['app_email'] = "Adresse email";
$lang['app_password'] = "Mot de passe";
$lang['app_confirm_password'] = "Confirmation du mot de passe";
$lang['app_email_placeholder'] = "Entrez votre email";
$lang['app_password_placeholder'] = "Choisir un mot de passe";
$lang['app_confirm_password_placeholder'] = "Ré-écrire votre mot de passe";
$lang['app_retrieve_password_placeholder'] = "Entrez l'email de votre compte $app_name";
$lang['app_alias'] = "Nom d'utilisateur";
$lang['app_city'] = "Ville";
$lang['app_website'] = "Site web";
$lang['app_bio'] = "A propos de vous";
$lang['app_bio_placeholder'] = "Décrire rapidement vos centres d'intérêts";
$lang['app_activity_name'] = "Nom de l'activité";
$lang['app_activity_name_help'] = "Ex: Faire des crêpes, Jouer au scrabble, Aller à la piscine, ...";
$lang['app_activity_name_placeholder'] = "Titre de l'activité proposée";
$lang['app_activity_users'] = "Avec";
$lang['app_activity_users_help'] = "Ecrire un nom ou un email pour chaque personne intéressée par cette activité";
$lang['app_activity_users_placeholder'] = "Liste des personnes intéressées";
$lang['app_activity_description'] = "Description";
$lang['app_activity_description_help'] = "Décrire en détail ce que vous proposez de faire. Vous pouvez y mettre des informations pratiques sur le lieu, le nombre de personne minimum, etc..";
$lang['app_activity_description_placeholder'] = "Quoi? Où? Comment? Avec qui?";
$lang['app_activity_image'] = "Image";
$lang['app_activity_image_help'] = "Mettre une image de bonne qualité correspondant à l'activité décrite";
$lang['app_apply_intro'] = "Laisser un commentaire à <span class='owner-name'>l'organisateur</span> pour <span class='activity-name'>cette activité</span>";
$lang['app_apply_comment_help'] = "Cette information est optionnelle et visible uniquement par l'organisateur de l'activité";
$lang['app_apply_comment_placeholder'] = "Votre commentaire (facultatif)";
$lang['app_apply_title'] = "S'inscrire à cette activité";

/**** Messages */
//$lang['app_sigin_error'] = "Connexion refusée";
$lang['app_register_error'] = "L'enregistrement à échouer.";
$lang['app_register_email_exists_error'] = "Il existe déjà un compte avec l'email %s.";
$lang['app_retrieve_password_success'] = "Votre mot de passe a été envoyé à l'adresse '%s'";
$lang['app_retrieve_password_error'] = "Aucun compte utilisateur ne correspond à l'email '%s'.";
$lang['app_confirmation_ok'] = "Votre compte a été correctement activé. Nous vous en remercions.";
$lang['app_confirmation_error'] = "Activation de votre compte impossible. $contact_admin";
$lang['app_user_save_success'] = "Vos paramètres utilisateur ont été correctement enregistré.";
$lang['app_user_save_error'] = "Une erreur est survenue lors de l'enregistrement de vos paramètres. $contact_admin";
$lang['app_activity_save_error'] = "Une erreur est survenue lors de l'enregistrement de l'activité. $contact_admin";
$lang['app_no_current_user_error'] = "Vous devez être connecter pour effectuer cette action.";
$lang['app_activity_unknown_error'] = "L'activité sélectionnée n'existe pas. $contact_admin";
$lang['app_activity_delete'] = "Êtes-vous sûr de vouloir supprimer l'activité <em>%s</em>?";
$lang['app_apply_error'] = "Une erreur est survenue lors de l'inscription à une activité. $contact_admin";
$lang['app_apply_success'] = "Vous avez été inscrit(e) à l'activité. Plus qu'à attendre qu'elle soit organisée.";
$lang['app_activity_disclaim'] = "Êtes-vous sûr de ne plus vouloir <em>%s</em>?";
$lang['app_activity_user_disclaim'] = "Êtes-vous sûr de vouloir retirer <em>%s</em> de la liste?";

/**** Emails */
$signature = "
L'équipe $app_name
$site_url";

$lang['email_user_confirmation_title'] = "Veuillez confirmer votre adresse email";
$lang['email_user_confirmation_content'] = "Bonjour, 
Merci d'avoir rejoint $app_name ! 
Pour terminer la procédure d'inscription, il vous suffit de confirmer que votre adresse e-mail est correcte en cliquant sur le lien suivant: %s .
$signature";

$lang['app_mail_password_retrieval_title'] = "Récupération du mot de passe $app_name";
$lang['app_mail_password_retrieval_content'] = "Bonjour,
Voici votre nouveau mot de passe: %s.
Il est conseillé de le modifier rapidement. 
Pour cela accédez à la page de votre compte et enregistrez un nouveau mot de passe: %s
$signature";

$lang['app_mail_apply_activity_title'] = "%s est intéressé pour %s";
$lang['app_mail_apply_activity_content'] = "Bonjour %s,
Nous vous informons que %s est intéressé(e) pour %s. N'oubliez pas de le/la contacter la prochaine fois. %s
Pour voir tous les inscrits rendez-vous sur: %s.
$signature";
$lang['app_mail_apply_user_comment'] = "
%s vous a laissé le commentaire suivant:
------------------------------
%s
------------------------------
";

/* End of file application_lang.php */
/* Location: ./application/language/french/application_lang.php */