            <div class="bg-dark border text-white rounded-3 p-1 h-100 sticky-top">
                <h6 class="d-none d-sm-block text-muted">Sticky Sidebar</h6>
                <ul class="nav nav-pills flex-sm-column flex-row mb-auto justify-content-between text-truncate">
                    <li class="nav-item">
                        <a href="{{ route('welcome') }}" class="nav-link px-2 text-truncate">
                            <i class="bi bi-house fs-4"></i>
                            <span class="d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('evenements.index') }}" class="nav-link px-2 text-truncate">
                            <i class="bi bi-calendar-event fs-4"></i>
                            <span class="d-none d-sm-inline">Évènements</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('messages.index') }}" class="nav-link px-2 text-truncate">
                            <i class="bi bi-calendar-event fs-4"></i>
                            <span class="d-none d-sm-inline">Messages</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('articles.index') }}" class="nav-link px-2 text-truncate">
                            <i class="bi bi-calendar-event fs-4"></i>
                            <span class="d-none d-sm-inline">Articles</span>
                        </a>
                    </li>
                    <div class="dropdown align-self-center mt-5">
                        <a href="#" class="d-flex align-items-center
                               justify-content-start p-3 link-dark text-decoration-none dropdown-toggle"
                               id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-person-circle h2 me-2"></i>{{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                          <hr class="dropdown-divider">
                        </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                        </a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    </ul>
                </div>
                </ul>
            </div>
