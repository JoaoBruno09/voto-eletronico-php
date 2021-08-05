<?php include "header.php"; ?>
<ul id="menu_nav_side_bar" class="navbar-nav sidebar nav-pills nav-flush d-flex flex-column mb-auto text-center">
    <li class="d-flex justify-content-center mb-3">
        <img alt="Logo" class="img-fluid logo" src="https://voto-eletronico.jbr-projects.pt/assets/img/logo.png">
    </li>
    <li id="a-dashboard" class="nav-link pad-li  tittle-side-bar">
        <button class="no-btn" onclick="call_page_dashboard()"><i id="icon-dashboard" class="fas fa-tachometer-alt icon-class-admin"></i></button>
        <a class="nav-link tittle-side-bar label-not-display" onclick="call_page_dashboard()">
            Dashboard
        </a>
    </li>
    <li id ="a-users" class="nav-link pad-li tittle-side-bar">
        <button class="no-btn"><i id="icon-utilizadores" class="fas fa-users icon-class-admin" ></i></button>
        <a class="nav-link tittle-side-bar label-not-display dropdown-toggle" >
            Utilizadores
        </a>
        <div class="collapse" id="collapseUsers">
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item tittle-side-bar">
                    <button class="no-btn" type="button" id="btn-user-add" onclick="call_page_add_user()">Adicionar Utilizador</button>
                    <br>
                    <hr class="hr-centered d-flex align-items-center " id="hr-special-users">
                    <button class="no-btn" type="button" id="btn-users-see" onclick="call_page_see_users()">Ver Utilizadores</button>
                </li>
            </ul>
        </div>
    </li>
    <li id="a-events" class="nav-link pad-li tittle-side-bar">
        <button class="no-btn"><i id="icon-eventos" class="fas fa-calendar-week icon-class-admin"></i></button>
        <a class="nav-link tittle-side-bar label-not-display dropdown-toggle" >
            Eventos
        </a>
        <div class="collapse" id="collapseEvents">
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item tittle-side-bar">
                    <button class="no-btn" type="button" id="btn-event-add" onclick="call_page_add_event()">Adicionar Evento</button><br>
                    <hr class="hr-centered d-flex align-items-center " id="hr-special-events">
                    <button class="no-btn" type="button" id="btn-events-see" onclick="call_page_see_events();">Ver Eventos</button>
                </li>
            </ul>
        </div>
    </li>
    <li id="a-candidates" class="nav-link pad-li tittle-side-bar">
        <button class="no-btn"><i id="icon-candidatos" class="fas fa-user-tie icon-class-admin"></i></button>
        <a class="nav-link tittle-side-bar label-not-display dropdown-toggle" >
            Candidatos
        </a>
        <div class="collapse" id="collapseCandidates">
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item tittle-side-bar">
                    <button class="no-btn" type="button" id="btn-candidate-add" onclick="call_page_add_candidate()">Adicionar Candidato</button><br>
                    <hr class="hr-centered d-flex align-items-center " id="hr-special-candidates">
                    <button class="no-btn" type="button" id="btn-candidates-see" onclick="call_page_see_candidates();">Ver Candidatos</button>
                </li>
            </ul>
        </div>
    </li>
    <li id="a-documents" class="nav-link pad-li tittle-side-bar">
        <button class="no-btn"><i id="icon-documentos" class="fas fa-id-card icon-class-admin"></i></button>
        <a class="nav-link tittle-side-bar label-not-display dropdown-toggle" >
            Documentos
        </a>
        <div class="collapse" id="collapseDoc">
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item tittle-side-bar">
                    <button class="no-btn" type="button" id="btn-doc-add" onclick="call_page_add_document()">Adicionar Documento</button><br>
                    <hr class="hr-centered d-flex align-items-center" id="hr-special-docs">
                    <button class="no-btn" type="button" id="btn-docs-see" onclick="call_page_see_documents();">Ver Documentos</button>
                </li>
            </ul>
        </div>
    </li>
    <li id="avatar" class="border-top d-flex align-items-left justify-content-left p-3 link-dark text-decoration-none div-avatar">
        <i style="color: #f7b03e;" class="fas fa-user" id="ico-user"></i>&nbsp;&nbsp;<h6 id="name-avatar"><?php echo utf8_encode($_SESSION['user_name']); ?></h6>
    </li>
</ul>