<?php
$app_name = "Lets";
$contact_admin = "Se o problema se repete, por favor entre em contato %s"; 
$site_url = site_url('');

$lang['app_site_name'] = "Lets - De verdade";
$lang['app_home'] = "Pagina Inicial";

/**** Génériques */
$lang['app_apply'] = "Lets";
$lang['app_disclaim'] = '<span class="disclaim">Lets</span>';
$lang['app_close'] = "Fechar";
$lang['app_cancel'] = "Anular";
$lang['app_connect'] = "Entrar";
$lang['app_disconnect'] = "Sair";
$lang['app_register'] = "Cadastrar-se";
$lang['app_already_account'] = "Ja tem um perfil";
$lang['app_my_account'] = "Meu perfil e minhas atividades";
$lang['app_retrieve_password'] = "Esqueceu sua senha?";
$lang['app_save'] = "Salvar";//?
$lang['app_send'] = "Enviar";
$lang['app_remove'] = "Retirar";
$lang['app_delete'] = "Deletar";
$lang['app_browse'] = "Esclher uma imagem";
$lang['app_parameters'] = "Informaçoes do perfil";
$lang['app_yes'] = "Sim";
$lang['app_no'] = "Nao";
$lang['app_back_to_profile'] = "Voltar ao perfil";

/**** Globals */
$lang['app_activity'] = "Atividade";
$lang['app_activities'] = "Atividades";

/**** Modals */
$lang['app_login_title'] = "Conectar-se a $app_name";
$lang['app_register_title'] = "Criar um novo perfil $app_name";
$lang['app_password_title'] = "Recuperaçao da senha";
$lang['app_new_activity_title'] = "Acrescentar uma atividade";

/**** Form labels */
$lang['app_name'] = "Nome";
$lang['app_avatar'] = "Imagem";
$lang['app_email'] = "E-mail";
$lang['app_password'] = "Senha";
$lang['app_confirm_password'] = "Confirmaçao da senha";
$lang['app_email_placeholder'] = "Escreva seu e-mail";
$lang['app_password_placeholder'] = "Escolher uma senha";
$lang['app_confirm_password_placeholder'] = "Escreva novamente sua senha";
$lang['app_retrieve_password_placeholder'] = "Escreva o e-mail do seu perfil $app_name";
$lang['app_alias'] = "Nome de usuário";
$lang['app_city'] = "Cidade";
$lang['app_website'] = "Website";
$lang['app_bio'] = "Sobre você";
$lang['app_bio_placeholder'] = "Descreva rapidamente suas areas de interesse";
$lang['app_activity_name'] = "Nome da atividade";
$lang['app_activity_name_help'] = "Ex: Fazer crêpes, Jogar imagem e açao, Ir na piscina, ...";
$lang['app_activity_name_placeholder'] = "Titulo da atividade proposta";
$lang['app_activity_users'] = "Com";
$lang['app_activity_users_help'] = "Escreva um nome ou um email para cada pessoa interessada por esta atividade";
$lang['app_activity_users_placeholder'] = "Lista des pessoas interessadas";
$lang['app_activity_description'] = "Descriçao";
$lang['app_activity_description_help'] = "Déescreva em detalhes o que você propoe. Você pode colocar informaçoes praticas sobre o lugar, o numero minimo de pessoas, etc..";
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