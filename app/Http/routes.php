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
    /*routes for blog*/
	Route::group(array('prefix' => 'blog'), function () {
        Route::get('/', array('as' => 'blogs', 'uses' => 'BlogController@index'));
        Route::get('create', array('as' => 'create/blog', 'uses' => 'BlogController@create'));
        Route::post('create', 'BlogController@store');
        Route::get('{blog}/edit', array('as' => 'update/blog', 'uses' => 'BlogController@edit'));
        Route::post('{blog}/edit', 'BlogController@update');
        Route::get('{blog}/delete', array('as' => 'delete/blog', 'uses' => 'BlogController@destroy'));
		Route::get('{blog}/confirm-delete', array('as' => 'confirm-delete/blog', 'uses' => 'BlogController@getModalDelete'));
		Route::get('{blog}/restore', array('as' => 'restore/blog', 'uses' => 'BlogController@getRestore'));
        Route::get('{blog}/show', array('as' => 'blog/show', 'uses' => 'BlogController@show'));
        Route::post('{blog}/storecomment', array('as' => 'restore/blog', 'uses' => 'BlogController@storecomment'));
	});

    /*routes for blog category*/
	Route::group(array('prefix' => 'blogcategory'), function () {
        Route::get('/', array('as' => 'blogcategories', 'uses' => 'BlogCategoryController@index'));
        Route::get('create', array('as' => 'create/blogcategory', 'uses' => 'BlogCategoryController@create'));
        Route::post('create', 'BlogCategoryController@store');
        Route::get('{blogcategory}/edit', array('as' => 'update/blogcategory', 'uses' => 'BlogCategoryController@edit'));
        Route::post('{blogcategory}/edit', 'BlogCategoryController@update');
        Route::get('{blogcategory}/delete', array('as' => 'delete/blogcategory', 'uses' => 'BlogCategoryController@destroy'));
		Route::get('{blogcategory}/confirm-delete', array('as' => 'confirm-delete/blogcategory', 'uses' => 'BlogCategoryController@getModalDelete'));
		Route::get('{blogcategory}/restore', array('as' => 'restore/blogcategory', 'uses' => 'BlogCategoryController@getRestore'));
	});

	/*routes for file*/
	Route::group(array('prefix' => 'file'), function () {
        Route::post('create', 'FileController@store');
		Route::post('createmulti', 'FileController@postFilesCreate');
		Route::delete('delete', 'FileController@delete');
	});

	Route::get('crop_demo', function () {
        return redirect('admin/imagecropping');
    });
    Route::post('crop_demo','JoshController@crop_demo');

	/* laravel example routes */
	# datatables
	Route::get('datatables', 'DataTablesController@index');
	Route::get('datatables/data', array('as' => 'admin.datatables.data', 'uses' => 'DataTablesController@data'));

    //tasks section
    Route::post('task/create', 'TaskController@store');
    Route::get('task/data', 'TaskController@data');
    Route::post('task/{task}/edit', 'TaskController@update');
    Route::post('task/{task}/delete', 'TaskController@delete');


	# Remaining pages will be called from below controller method
	# in real world scenario, you may be required to define all routes manually

	Route::get('{name?}', 'JoshController@showView');
	
	Route::group(array('prefix' => 'avaliacao'), function () {
		Route::get('/', 'AvaliacaoController@paineladmin');
		Route::get('/painel', 'AvaliacaoController@paineladmin');
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
Route::get('/avaliacao/', 'AvaliacaoController@index');
Route::get('/avaliacao/painel', 'AvaliacaoController@painel');
Route::get('/avaliacao/mostra', 'AvaliacaoController@mostra');
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
