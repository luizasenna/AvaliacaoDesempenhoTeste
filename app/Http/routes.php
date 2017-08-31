<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Model binding into route
 */
Route::model('blogcategory', 'App\BlogCategory');
Route::model('blog', 'App\Blog');
Route::model('file', 'App\File');
Route::model('task', 'App\Task');
Route::model('users', 'App\User');

Route::pattern('slug', '[a-z0-9- _]+');

Route::post('atualizacao.formulario', 'AtualizacaoController@formulario');

Route::group(array('prefix' => 'admin'), function () {

	# Error pages should be shown without requiring login
	Route::get('404', function () {
		return View('admin/404');
	});
	Route::get('500', function () {
		return View::make('admin/500');
	});

	# Lock screen
	Route::get('lockscreen', function () {
		return View::make('admin/lockscreen');
	});

	#cron
		Route::get('/cron', 'AvaliacaoController@cron');
	
	# All basic routes defined here
	Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
	Route::post('signin', 'AuthController@postSignin');
	Route::post('signup', array('as' => 'signup', 'uses' => 'AuthController@postSignup'));
	Route::post('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@postForgotPassword'));
	Route::get('login2', function () {
		return View::make('admin/login2');
	});

	# Register2
	Route::get('register2', function () {
		return View::make('admin/register2');
	});
	Route::post('register2', array('as' => 'register2', 'uses' => 'AuthController@postRegister2'));

	# Forgot Password Confirmation
	Route::get('forgot-password/{userId}/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
	Route::post('forgot-password/{userId}/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

	# Logout
	Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

	# Account Activation
	Route::get('activate/{userId}/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));
});

Route::group(array('prefix' => 'admin', 'middleware' => 'SentinelAdmin'), function () {
    # Dashboard / Index
	Route::get('/', array('as' => 'dashboard','uses' => 'JoshController@showHome'));


    # User Management
    Route::group(array('prefix' => 'users'), function () {
        Route::get('/', array('as' => 'users', 'uses' => 'UsersController@index'));
        Route::get('create', 'UsersController@create');
        Route::post('create', 'UsersController@store');
        Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'UsersController@destroy'));
        Route::get('{userId}/confirm-delete', array('as' => 'confirm-delete/user', 'uses' => 'UsersController@getModalDelete'));
        Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'UsersController@getRestore'));
        Route::get('{userId}', array('as' => 'users.show', 'uses' => 'UsersController@show'));
        Route::post('passwordreset', 'UsersController@passwordreset');
    });
    Route::resource('users', 'UsersController');

	Route::get('deleted_users',array('as' => 'deleted_users','before' => 'Sentinel', 'uses' => 'UsersController@getDeletedUsers'));

	# Group Management
    Route::group(array('prefix' => 'groups'), function () {
        Route::get('/', array('as' => 'groups', 'uses' => 'GroupsController@index'));
        Route::get('create', array('as' => 'create/group', 'uses' => 'GroupsController@create'));
        Route::post('create', 'GroupsController@store');
        Route::get('{groupId}/edit', array('as' => 'update/group', 'uses' => 'GroupsController@edit'));
        Route::post('{groupId}/edit', 'GroupsController@update');
        Route::get('{groupId}/delete', array('as' => 'delete/group', 'uses' => 'GroupsController@destroy'));
        Route::get('{groupId}/confirm-delete', array('as' => 'confirm-delete/group', 'uses' => 'GroupsController@getModalDelete'));
        Route::get('{groupId}/restore', array('as' => 'restore/group', 'uses' => 'GroupsController@getRestore'));
    });
 
	Route::get('crop_demo', function () {
        return redirect('admin/imagecropping');
    });
    Route::post('crop_demo','JoshController@crop_demo');

	/* laravel example routes */
	# datatables
	Route::get('datatables', 'DataTablesController@index');
	Route::get('datatables/data', array('as' => 'admin.datatables.data', 'uses' => 'DataTablesController@data'));

	Route::get('{name?}', 'JoshController@showView');
	
	# Rotas Avaliação no Admin
	Route::group(array('prefix' => 'avaliacao'), function () {
		Route::get('/', 'AvaliacaoController@paineladmin');
		Route::get('/painel', 'AvaliacaoAdminController@avaliacoes')->name('painel');
		Route::get('/media2016', 'AvaliacaoAdminController@mediaAvaliacao')->name('media2016');
		Route::get('/mediaImpressao', 'AvaliacaoAdminController@mediaImpressao')->name('mediaImpressao');
		Route::get('/pendente2016', 'AvaliacaoAdminController@pendente2016')->name('pendente2016');
		Route::get('/pessoa/{id}', 'AvaliacaoAdminController@pessoa')->name('pessoa_show');
		Route::get('/progresso', 'AvaliacaoAdminController@progressoAvaliacao');
		Route::get('/delegacao', 'AvaliacaoAdminController@painelDelegar');
		Route::get('/equipe', 'AvaliacaoAdminController@equipe');
		Route::get('/avaliado', 'AvaliacaoAdminController@avaliado');
		Route::get('/delega', 'AvaliacaoAdminController@delega');
		Route::get('/delegaTodas', 'AvaliacaoAdminController@delegaTodas');
		Route::get('/delegaUma', 'AvaliacaoAdminController@delegaUma');
		Route::get('/delegaVarias', 'AvaliacaoAdminController@delegaVarias');
		Route::get('/teste', 'AvaliacaoAdminController@teste');
		Route::get('/historicoDelegacao', 'AvaliacaoAdminController@historicoDelegacao');
		Route::get('/mudaequipe', 'AvaliacaoAdminController@mudaEquipe');
		Route::get('/func', 'AvaliacaoAdminController@verTime');
		Route::post('/outraEquipe', 'AvaliacaoAdminController@outraEquipe');
		Route::get('/historicoEquipe', 'AvaliacaoAdminController@mostraHistoricoEquipe');
	});
	

		

});

#FrontEndController
Route::get('login', array('as' => 'login','uses' => 'FrontEndController@getLogin'));
Route::post('login','FrontEndController@postLogin');
Route::get('register', array('as' => 'register','uses' => 'FrontEndController@getRegister'));
Route::post('register','FrontEndController@postRegister');
Route::get('activate/{userId}/{activationCode}',array('as' =>'activate','uses'=>'FrontEndController@getActivate'));
Route::get('forgot-password',array('as' => 'forgot-password','uses' => 'FrontEndController@getForgotPassword'));
Route::post('forgot-password','FrontEndController@postForgotPassword');
# Forgot Password Confirmation
Route::get('forgot-password/{userId}/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'FrontEndController@getForgotPasswordConfirm'));
Route::post('forgot-password/{userId}/{passwordResetCode}', 'FrontEndController@postForgotPasswordConfirm');
# My account display and update details
Route::group(array('middleware' => 'SentinelUser'), function () {
	Route::get('my-account', array('as' => 'my-account', 'uses' => 'FrontEndController@myAccount'));
    Route::put('my-account', 'FrontEndController@update');
});
Route::get('logout', array('as' => 'logout','uses' => 'FrontEndController@getLogout'));
# contact form
Route::post('contact',array('as' => 'contact','uses' => 'FrontEndController@postContact'));

#frontend views
Route::group(['middleware' => 'SentinelUser'], function () {

/*Route::get('/', array('as' => 'home', function () {
    return View::make('index');
}));*/

Route::get('/', array('as' => 'home','uses' => 'FrontEndController@inicio'));

Route::get('index', array('as' => 'home','uses' => 'FrontEndController@inicio'))->name('index');


Route::get('/cadastro', array('as' => 'cadastro', function () {
    return View::make('cadastro');
}));


Route::get('/painelservico', 'ServicoController@index');

Route::get('/adicionaservico', 'ServicoController@create');

Route::get('/servico', 'ServicoController@index');

Route::get('/atualizacao', 'AtualizacaoController@index');

Route::get('/avaliacao/index', array('as' => 'avaliacao','uses' => 'AvaliacaoController@index'));
Route::get('/avaliacao/', 'AvaliacaoController@index')->name('avaliacao');
Route::get('/avaliacao/painel', 'AvaliacaoController@painel');
Route::get('/avaliacao/mostra', 'AvaliacaoController@mostra')->name('mostra');
Route::get('/avaliacao/insere', 'AvaliacaoController@insere');
Route::get('/avaliacao/notas', 'AvaliacaoController@visao');
Route::get('/avaliacao/inserenota', 'AvaliacaoController@inserenota');
Route::get('/avaliacao/inserevalor', 'AvaliacaoController@inserenota');
Route::get('/avaliacao/valida', 'AvaliacaoController@valida');
Route::get('/avaliacao/delegaUma', 'AvaliacaoController@delegaUma');
Route::get('/avaliacao/delegaTodas', 'AvaliacaoController@delegaTodas');
Route::get('/avaliacao/delegaUmaAvaliacao', 'AvaliacaoController@delegaUmaAvaliacao');
Route::get('/avaliacao/delegaVarias', 'AvaliacaoController@delegaVarias');
Route::post('/avaliacao/historicoDelegacao/filtro', 'AvaliacaoController@delegaFiltro');
Route::post('/avaliacao/historicoDelegacao/busca', 'AvaliacaoController@delegaBusca');
Route::get('/avaliacao/avaliado', 'AvaliacaoController@avaliado');

});

Route::group(array('prefix' => 'agenda'), function () {
		Route::get('/', 'AgendaController@index');
		Route::post('/busca', 'AgendaController@busca');
		Route::get('/insere', 'AgendaController@insere');
		Route::get('/inserePessoa', 'AgendaController@inserePessoa');
		Route::get('/insereEmpresa', 'AgendaController@insereEmpresa');
		Route::post('/addPessoa', 'AgendaController@addPessoa');
		Route::get('/pessoa/{id}', 'AgendaController@pessoa')->name('pessoa_mostra');

	
});

Route::get('blog', array('as' => 'blog', 'uses' => 'BlogController@getIndexFrontend'));
Route::get('blog/{slug}/tag', 'BlogController@getBlogTagFrontend');
Route::get('blogitem/{slug?}', 'BlogController@getBlogFrontend');
Route::post('blogitem/{blog}/comment', 'BlogController@storeCommentFrontend');

Route::get('{name?}', 'JoshController@showFrontEndView');
# End of frontend views

$s = 'social.';
Route::get('/social/redirect/{provider}',   ['as' => $s . 'redirect',   'uses' => 'AuthController@redirectToProvider']);
Route::get('/social/handle/google',     ['as' => $s . 'handle',     'uses' => 'AuthController@handleProviderCallback']);

Route::group(array('prefix' => 'admin', 'middleware' => 'SentinelAdmin'), function () {Route::resource('veravaliacaos', 'VeravaliacaosController');
	Route::get('veravaliacaos/{id}/delete', array('as' => 'admin.veravaliacaos.delete', 'uses' => 'VeravaliacaosController@getDelete'));
	Route::get('veravaliacaos/{id}/confirm-delete', array('as' => 'admin.veravaliacaos.confirm-delete', 'uses' => 'VeravaliacaosController@getModalDelete'));
});

Route::group(array('prefix' => 'admin', 'middleware' => 'SentinelAdmin'), function () {Route::resource('vercargos', 'VercargosController');
	Route::get('vercargos/{id}/delete', array('as' => 'admin.vercargos.delete', 'uses' => 'VercargosController@getDelete'));
	Route::get('vercargos/{id}/confirm-delete', array('as' => 'admin.vercargos.confirm-delete', 'uses' => 'VercargosController@getModalDelete'));
});
