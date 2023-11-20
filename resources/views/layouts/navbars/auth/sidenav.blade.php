<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <div class="navbar-brand m-0">
            <span class="ms-1 font-weight-bold">Estoque Norven</span>
        </div>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mt-3 d-flex align-items-center">
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Fluxo de Estoque</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'estoque' ? 'active' : '' }}" href="{{ route('estoque.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-shopping-cart text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Estoque</span>
                </a>
            </li>

            <li class="nav-item mt-3 d-flex align-items-center">
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Cadastros</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'categoria' ? 'active' : '' }}" href="{{ route('categoria.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bars text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Categoria</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'marca' ? 'active' : '' }}" href="{{ route('marca.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bars text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Marca</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'produto' ? 'active' : '' }}" href="{{ route('produto.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bars text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Produto</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'lote' ? 'active' : '' }}" href="{{ route('lote.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bars text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lote</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'fornecedor' ? 'active' : '' }}" href="{{ route('fornecedor.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bars text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Fornecedor</span>
                </a>
            </li>

            <li class="nav-item mt-3 d-flex align-items-center">
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Configurações</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'user' ? 'active' : '' }}" href="{{ route('user.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bars text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Usuário</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
