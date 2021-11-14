<nav id="main-menu">
    <ul>
        <li>
            <a href="{{ route('user.index') }}">
                <i class="fa fa-address-book"></i><h3>Usuários</h3>
            </a>
        </li>
        <li>
            <a href="{{ route('institution.index') }}">
                <i class="fa fa-building"></i><h3>Instituições</h3>
            </a>
        </li>
        <li>
            <a href="{{ route('group.index') }}">
                <i class="fa fa-users"></i><h3>Grupos</h3>
            </a>
        </li>
        <li>
            <a href="{{ route('movement.deposit') }}">
                <i class="far fa-money-bill-alt"></i><h3>Depositar</h3>
            </a>
        </li>
        <li>
            <a href="{{ route('movement.withdraw') }}">
                <i class="far fa-money-bill-alt"></i><h3>Resgatar</h3>
            </a>
        </li>
        <li>
            <a href="{{ route('movement.index') }}">
                <i class="fa fa-dollar-sign"></i><h3>Aplicações</h3>
            </a>
        </li>
        <li>
            <a href="{{ route('movement.statement') }}">
                <i class="fa fa-dollar-sign"></i><h3>Extrato</h3>
            </a>
        </li>
    </ul>
</nav>

