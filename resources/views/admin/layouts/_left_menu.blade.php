<ul id="menu" class="page-sidebar-menu">
    <li {!! (Request::is('admin') ? 'class="active"' : '') !!}>
        <a href="{{ route('dashboard') }}">
            <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Painel</span>
        </a>
    </li>


    <li {!! (Request::is('admin/form_examples') || Request::is('admin/editor') || Request::is('admin/editor2') || Request::is('admin/form_layout') || Request::is('admin/validation') || Request::is('admin/formelements') || Request::is('admin/form_layouts') || Request::is('admin/formwizard') || Request::is('admin/accordionformwizard') || Request::is('admin/datepicker')? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="doc-portrait" data-c="#67C5DF" data-hc="#67C5DF"
               data-size="18" data-loop="true"></i>
            <span class="title">Avaliações</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
          <li {!! (Request::is('admin/avaliacao/assiduidade') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/avaliacao/assiduidade') }}">
                <i class="fa fa-angle-double-right"></i>
                Assiduidade
            </a>
              <ul>
                <li>
                  <a href="{{ route('mostraAssiduidade') }}">
                      <i class="livicon" data-name="list" data-c="#67C5DF" data-hc="#67C5DF"
                         data-size="18" data-loop="true"></i>
                      <span class="title">Ver Todas</span>

                  </a>
                </li>
                <li>
                  <a href="{{ route('insereAssiduidade') }}">
                      <i class="livicon" data-name="plus-alt" data-c="#67C5DF" data-hc="#67C5DF"
                         data-size="18" data-loop="true"></i>
                      <span class="title">Calcular Nova</span>

                  </a>
                </li>
                <li>
                    <a href="{{ URL::to('admin/abonos') }}">
                      <i class="livicon" data-name="pencil" data-c="#67C5DF" data-hc="#67C5DF"
                         data-size="18" data-loop="true"></i>
                      <span class="title">Abonos Considerados</span>


                    </a>
                </li>
              </ul>


    			</li>
			<li {!! (Request::is('admin/avaliacao/progresso') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/avaliacao/progresso') }}">
                <i class="fa fa-angle-double-right"></i>
                Progresso
            </a>
			</li>
			<li {!! (Request::is('admin/avaliacao/media2016') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/avaliacao/media2016Geral') }}">
                <i class="fa fa-angle-double-right"></i>
                Média Anual - Todos
            </a>
			</li>
			<li {!! (Request::is('admin/avaliacao/painel') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/avaliacao/painel') }}">
                <i class="fa fa-angle-double-right"></i>
                Por Funcionário
            </a>
			</li>
			<li {!! (Request::is('admin/avaliacao/painel') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/avaliacao/painel') }}">
                <i class="fa fa-angle-double-right"></i>
                Por Equipe
            </a>
			</li>
			<li {!! (Request::is('admin/avaliacao/delegacao') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/avaliacao/delegacao') }}">
                <i class="fa fa-angle-double-right"></i>
                Delegação de ADs
            </a>
			</li>
			<li {!! (Request::is('admin/avaliacao/historicoDelegacao') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/avaliacao/historicoDelegacao') }}">
                <i class="fa fa-angle-double-right"></i>
                Histórico de Delegação de ADs
            </a>
			</li>
            <li {!! (Request::is('admin/avaliacao/historicoEquipe') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/avaliacao/historicoEquipe') }}">
                <i class="fa fa-angle-double-right"></i>
                Histórico de Equipes
            </a>
            </li>
            <li {!! (Request::is('admin/veravaliacaos') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/veravaliacaos') }}">
                <i class="fa fa-angle-double-right"></i>
                Visualização de ADs Importadas
            </a>
			</li>
            <li {!! (Request::is('admin/avaliacao/notaBaixa') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/avaliacao/notaBaixa') }}">
                <i class="fa fa-angle-double-right"></i>
                Notas Baixas
            </a>
        </li>
        <li {!! (Request::is('admin/vercargos') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/vercargos') }}">
                <i class="fa fa-angle-double-right"></i>
                Competências Avaliadas por Cargo
            </a>
        </li>



        </ul>
    </li>


<li {!! (Request::is('admin/users') || Request::is('admin/users/create') || Request::is('admin/editor2') || Request::is('admin/form_layout') || Request::is('admin/validation') || Request::is('admin/formelements') || Request::is('admin/form_layouts') || Request::is('admin/formwizard') || Request::is('admin/accordionformwizard') || Request::is('admin/datepicker')? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="users" data-c="#67C5DF" data-hc="#67C5DF"
               data-size="18" data-loop="true"></i>
            <span class="title">Usuários</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/users/') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/users/') }}">
                <i class="fa fa-angle-double-right"></i>
                Ver todos
            </a>
			</li>
            <li {!! (Request::is('admin/users/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/users/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Criar Novo
            </a>
        </li>




        </ul>
    </li>


    <!-- Menus generated by CRUD generator -->
    @include('admin/layouts/menu')
</ul>
