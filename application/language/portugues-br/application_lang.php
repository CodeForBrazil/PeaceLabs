<?php
$app_name = "Lets";
$contact_admin = "Se o problema persistir, por favor entre em contato atraves deste email %s"; 
$site_url = site_url('');

$lang['app_site_name'] = "Lets - De verdade";
$lang['app_home'] = "Página Inicial";

/**** Génériques */
$lang['app_apply'] = "Lets";
$lang['app_disclaim'] = '<span class="disclaim">Lets</span>';
$lang['app_close'] = "Fechar";
$lang['app_cancel'] = "Cancelar";
$lang['app_connect'] = "Entrar";
$lang['app_disconnect'] = "Sair";
$lang['app_register'] = "Criar perfil";
$lang['app_already_account'] = "Já tenho um perfil";
$lang['app_my_account'] = "Meu perfil e minhas atividades";
$lang['app_retrieve_password'] = "Esqueceu sua senha?";
$lang['app_save'] = "Salvar";//?
$lang['app_send'] = "Enviar";
$lang['app_remove'] = "Retirar";
$lang['app_delete'] = "Deletar";
$lang['app_browse'] = "Escolher uma imagem";
$lang['app_parameters'] = "Informações do perfil";
$lang['app_yes'] = "Sim";
$lang['app_no'] = "Não";
$lang['app_back_to_profile'] = "Voltar ao perfil";

/**** Globals */
$lang['app_activity'] = "Atividade";
$lang['app_activities'] = "Atividades";

/**** Modals */
$lang['app_login_title'] = "Conectar-se a $app_name";
$lang['app_register_title'] = "Criar um novo perfil $app_name";
$lang['app_password_title'] = "Recuperação da senha";
$lang['app_new_activity_title'] = "Acrescentar uma atividade";

/**** Form labels */
$lang['app_name'] = "Nome";
$lang['app_avatar'] = "Imagem";
$lang['app_email'] = "E-mail";
$lang['app_password'] = "Senha";
$lang['app_confirm_password'] = "Confirmação da senha";
$lang['app_email_placeholder'] = "Escreva seu e-mail";
$lang['app_password_placeholder'] = "Escolher uma senha";
$lang['app_confirm_password_placeholder'] = "Escreva novamente sua senha";
$lang['app_retrieve_password_placeholder'] = "Escreva o e-mail do seu perfil $app_name";
$lang['app_alias'] = "Nome de usuário";
$lang['app_city'] = "Cidade";
$lang['app_website'] = "Website";
$lang['app_bio'] = "Sobre você";
$lang['app_bio_placeholder'] = "Descreva rapidamente suas áreas de interesse";
$lang['app_activity_name'] = "Nome da atividade";
$lang['app_activity_name_help'] = "Ex: Fazer crêpes, Jogar imagem e ação, Ir na piscina, ...";
$lang['app_activity_name_placeholder'] = "Título da atividade proposta";
$lang['app_activity_users'] = "Com";
$lang['app_activity_users_help'] = "Escreva um nome ou um email para cada pessoa interessada por esta atividade";
$lang['app_activity_users_placeholder'] = "Lista des pessoas interessadas";
$lang['app_activity_description'] = "Descrição";
$lang['app_activity_description_help'] = "Descreva em detalhes o que você propõe. Você pode colocar informações práticas sobre o lugar, o número mínimo de pessoas, etc..";
$lang['app_activity_description_placeholder'] = "O que? Onde? Como? Com quem?";
$lang['app_activity_image'] = "Imagem";
$lang['app_activity_image_help'] = "Inserir uma imagem de boa qualidade relacionada a atividade descrita";
$lang['app_apply_intro'] = "Deixar um comentário à <span class='owner-name'>l'organisateur</span> pour <span class='activity-name'>cette activité</span>";
$lang['app_apply_comment_help'] = "Esta informação é opcional e visível somente para o organizador da atividade";
$lang['app_apply_comment_placeholder'] = "Seu comentário (facultativo)";
$lang['app_apply_title'] = "Participar desta atividade";

/**** Messages */
//$lang['app_sigin_error'] = "Connexion refusée";
$lang['app_register_error'] = "Não foi possível salvar os dados.";
$lang['app_register_email_exists_error'] = "Já existe um perfil com o email %s.";
$lang['app_retrieve_password_success'] = "Sua senha foi enviada ao email '%s'";
$lang['app_retrieve_password_error'] = "Nenhum perfil de usuário corresponde ao email '%s'.";
$lang['app_confirmation_ok'] = "Seu perfil está ativado. Obrigada!";
$lang['app_confirmation_error'] = "Não foi possível ativar seu perfil. $contact_admin";
$lang['app_user_save_success'] = "Seus parâmetros de usuário foram salvos corretamente.";
$lang['app_user_save_error'] = "Um erro ocorreu ao salvar seus parâmetros. $contact_admin";
$lang['app_activity_save_error'] = "Um erro ocorreu ao salvar a atividade. $contact_admin";
$lang['app_no_current_user_error'] = "Você deve se conectar para efetuar esta ação.";
$lang['app_activity_unknown_error'] = "A atividade selecionada não existe. $contact_admin";
$lang['app_activity_delete'] = "Você tem certeza que quer deletar esta atividade <em>%s</em>?";
$lang['app_apply_error'] = "Um erro ocorreu na sua inscrição para esta atividade. $contact_admin";
$lang['app_apply_success'] = "Você se inscreveu a esta atividade. Agira é esperar pra que ela seja organizada.";
$lang['app_activity_disclaim'] = "Você tem certeza de não querer mais <em>%s</em>?";
$lang['app_activity_user_disclaim'] = "Você tem certeza que quer retirar <em>%s</em> da lista?";

/**** Emails */
$signature = "
A equipe $app_name
$site_url";

$lang['email_user_confirmation_title'] = "Confirme seu email";
$lang['email_user_confirmation_content'] = "Olá, 
Obrigada por juntar-se a nós $app_name ! 
Para terminar a inscrição, só resta confirmar que seu email está correto clicando neste link: %s .
$signature";

$lang['app_mail_password_retrieval_title'] = "Recuperação da senha $app_name";
$lang['app_mail_password_retrieval_content'] = "Olá,
Esta é sua nova senha: %s.
Conselho: troque sua senha rapidamente. 
Para fazer isso, vá até a página do seu perfil e escolha uma nova: %s
$signature";

$lang['app_mail_apply_activity_title'] = "%s está interessado(a) em %s";
$lang['app_mail_apply_activity_content'] = "Olá %s,
Informamos que %s está interessado(a) em %s. Não esqueça de avisá-lo(la) na próxima vez. %s
Para visualizar todos os inscritos vá para: %s.
$signature";
$lang['app_mail_apply_user_comment'] = "
%s Você deixou o seguinte comentário:
------------------------------
%s
------------------------------
";

/***** Home page */
$lang['app_home_intro'] = "
<p>
	<strong>Bem-vindo(a) ao $app_name!</strong> Este site é somente um protótipo mas é um <em>bom começo</em>. 
	O objetivo deste site é nos ajudar a passar mais
	 tempo <em> com amigos</em>, de <em>melhor conhecê-los</em>, criar <em>novas lembranças</em>, se encontrar 
	<strong>de verdade</strong>.
</p>
<p>
	<em>$app_name</em> te possibilita anotar <strong> o que você gosta ou gostaria de fazer</strong>, de associar
	os amigos que se interessam pelas mesmas atividades. Em seguida, outros amigos poderão se juntar espontaneamente. 
	No dia da atividade, você saberá quem chamar.             
	<em>Inscreva-se</em> e experimente! lembrando que este é um site embrião, só temos 5% 
	de <strong>ideias fantásticas</strong> que queremos realizar. 
	Se você tem sugestões, conselhos, problemas, 
	nos deixe saber por email: <em><<app_contact>></em>.
</p>
<p>
	<strong>Em breve</strong>: disposição das atividades por <em>Temas</em>, lista de amigos et <em>Privacidade</em>, Compartilhar e conexão com 
	<em>Facebook</em>. 
</p>
";
$lang['app_home_intro_connected'] = "
<p>
	<strong>Bem-vindo ao $app_name <em><<user_name>></em>'; ?> !</strong>
</p>
";
$lang['app_create_your_account'] = "Crie seu perfil no lets!";


/* End of file application_lang.php */
/* Location: ./application/language/french/application_lang.php */