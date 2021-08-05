//VARIAVEL COM O URL DO WEBSITE PARA SER UTILIZADA AO LONGO DESTE FICHEIRO
var url = "https://voto-eletronico.jbr-projects.pt/";

$(document).ready(function () {
    var myVar = setInterval(myTimer, 1000);
    function myTimer() {
        var d = new Date();
        var t = d.toLocaleString();
        $("#clock").text(t);
    }

    if ($(window).width() < 768) {
        $("#menu_nav_side_bar").addClass('toggle-sm');
        $("#icon-dashboard").addClass('icon-class-responsive');
        $("#icon-utilizadores").addClass('icon-class-responsive');
        $("#icon-eventos").addClass('icon-class-responsive');
        $("#icon-candidatos").addClass('icon-class-responsive');
        $("#icon-documentos").addClass('icon-class-responsive');
        $("#name-avatar").addClass('icon-class-responsive');
        $("#ico-user").addClass('icon-class-responsive');
        $("#name-avatar").addClass('icon-class-responsive');
        $("#btn-user-add").addClass('icon-class-responsive');
        $("#btn-users-see").addClass('icon-class-responsive');
        $("#btn-event-add").addClass('icon-class-responsive');
        $("#btn-events-see").addClass('icon-class-responsive');
        $("#btn-candidate-add").addClass('icon-class-responsive');
        $("#btn-candidates-see").addClass('icon-class-responsive');
        $("#btn-doc-add").addClass('icon-class-responsive');
        $("#btn-docs-see").addClass('icon-class-responsive');
        $("#hr-special-users").addClass('special-class-hr-special');
        $("#hr-special-events").addClass('special-class-hr-special');
        $("#hr-special-candidates").addClass('special-class-hr-special');
        $("#hr-special-docs").addClass('special-class-hr-special');
        $("a.nav-link.py-3.dropdown-toggle.tittle-side-bar").css("font-size", "0px");
        $("#avatar").removeClass('border-top');
    }

    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover_pw"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    });
});
function toggleMenu() {
    if ($(window).width() < 768) {
        if ($("#menu_nav_side_bar").hasClass("toggle-sm")) {
            $("#menu_nav_side_bar").removeClass('toggle-sm');
            $("#icon-dashboard").removeClass('icon-class-responsive');
            $("#icon-utilizadores").removeClass('icon-class-responsive');
            $("#icon-eventos").removeClass('icon-class-responsive');
            $("#icon-candidatos").removeClass('icon-class-responsive');
            $("#icon-documentos").removeClass('icon-class-responsive');
            $("#name-avatar").removeClass('icon-class-responsive');
            $("#btn-user-add").removeClass('icon-class-responsive');
            $("#btn-users-see").removeClass('icon-class-responsive');
            $("#btn-event-add").removeClass('icon-class-responsive');
            $("#btn-events-see").removeClass('icon-class-responsive');
            $("#btn-candidate-add").removeClass('icon-class-responsive');
            $("#btn-candidates-see").removeClass('icon-class-responsive');
            $("#btn-doc-add").removeClass('icon-class-responsive');
            $("#btn-docs-see").removeClass('icon-class-responsive');
            $("#hr-special-users").removeClass('special-class-hr-special');
            $("#hr-special-events").removeClass('special-class-hr-special');
            $("#hr-special-candidates").removeClass('special-class-hr-special');
            $("#hr-special-docs").removeClass('special-class-hr-special');
            $("a.nav-link.py-3.dropdown-toggle.tittle-side-bar").css("font-size", "18px");
            $("#avatar").addClass('border-top');
            $("#ico-user").removeClass('icon-class-responsive');
            $("#menu_nav_side_bar").addClass('toggle');
        } else {
            $("#menu_nav_side_bar").addClass('toggle-sm');
            $("#icon-dashboard").addClass('icon-class-responsive');
            $("#icon-utilizadores").addClass('icon-class-responsive');
            $("#icon-eventos").addClass('icon-class-responsive');
            $("#icon-candidatos").addClass('icon-class-responsive');
            $("#icon-documentos").addClass('icon-class-responsive');
            $("#name-avatar").addClass('icon-class-responsive');
            $("#ico-user").addClass('icon-class-responsive');
            $("#btn-user-add").addClass('icon-class-responsive');
            $("#btn-users-see").addClass('icon-class-responsive');
            $("#btn-event-add").addClass('icon-class-responsive');
            $("#btn-events-see").addClass('icon-class-responsive');
            $("#btn-candidate-add").addClass('icon-class-responsive');
            $("#btn-candidates-see").addClass('icon-class-responsive');
            $("#btn-doc-add").addClass('icon-class-responsive');
            $("#btn-docs-see").addClass('icon-class-responsive');
            $("#hr-special-users").addClass('special-class-hr-special');
            $("#hr-special-events").addClass('special-class-hr-special');
            $("#hr-special-candidates").addClass('special-class-hr-special');
            $("#hr-special-docs").addClass('special-class-hr-special');
            $("a.nav-link.py-3.dropdown-toggle.tittle-side-bar").css("font-size", "0px");
            $("#avatar").removeClass('border-top');
        }
    } else {
        if ($("#menu_nav_side_bar").hasClass("toggle")) {
            $("#menu_nav_side_bar").removeClass('toggle');
        } else {
            $("#menu_nav_side_bar").addClass('toggle');
        }
    }
}

step_progress_bar_change_user_pw = function () {
    var password = $('#user_new_password').val();
    var strength = 0;
    var arr = [/.{8,}/, /[a-z]+/, /[0-9]+/, /[!@#$%^&*(),.?":{}|<>]+/, /[A-Z]+/];
    jQuery.map(arr, function (regexp) {
        if (password.match(regexp))
            strength++;
    });

    if (strength == 1) {
        $('#progress-pw').width('20%');
        $('#progress-pw').text('20%');
    } else if (strength == 2) {
        $('#progress-pw').width('40%');
        $('#progress-pw').text('40%');
    } else if (strength == 3) {
        $('#progress-pw').width('60%');
        $('#progress-pw').text('60%');
    } else if (strength == 4) {
        $('#progress-pw').width('80%');
        $('#progress-pw').text('80%');
    } else if (strength == 5) {
        $('#progress-pw').width('100%');
        $('#progress-pw').text('100%');
    } else {
        $('#progress-pw').width('0%');
        $('#progress-pw').text('0%');
    }
}

step_progress_bar_add_user = function () {
    var password = $('#add_user_password').val();
    var strength = 0;
    var arr = [/.{8,}/, /[a-z]+/, /[0-9]+/, /[!@#$%^&*(),.?":{}|<>]+/, /[A-Z]+/];
    jQuery.map(arr, function (regexp) {
        if (password.match(regexp))
            strength++;
    });

    if (strength == 1) {
        $('#progress-pw').width('20%');
        $('#progress-pw').text('20%');
    } else if (strength == 2) {
        $('#progress-pw').width('40%');
        $('#progress-pw').text('40%');
    } else if (strength == 3) {
        $('#progress-pw').width('60%');
        $('#progress-pw').text('60%');
    } else if (strength == 4) {
        $('#progress-pw').width('80%');
        $('#progress-pw').text('80%');
    } else if (strength == 5) {
        $('#progress-pw').width('100%');
        $('#progress-pw').text('100%');
    } else {
        $('#progress-pw').width('0%');
        $('#progress-pw').text('0%');
    }
}

step_progress_bar = function () {
    var password = $('#change_password').val();
    var strength = 0;
    var arr = [/.{8,}/, /[a-z]+/, /[0-9]+/, /[!@#$%^&*(),.?":{}|<>]+/, /[A-Z]+/];
    jQuery.map(arr, function (regexp) {
        if (password.match(regexp))
            strength++;
    });

    if (strength == 1) {
        $('#progress-pw').width('20%');
        $('#progress-pw').text('20%');
    } else if (strength == 2) {
        $('#progress-pw').width('40%');
        $('#progress-pw').text('40%');
    } else if (strength == 3) {
        $('#progress-pw').width('60%');
        $('#progress-pw').text('60%');
    } else if (strength == 4) {
        $('#progress-pw').width('80%');
        $('#progress-pw').text('80%');
    } else if (strength == 5) {
        $('#progress-pw').width('100%');
        $('#progress-pw').text('100%');
    } else {
        $('#progress-pw').width('0%');
        $('#progress-pw').text('0%');
    }
}

//FUNÇÃO PARA RECUPERAR A PASSWORD
recover_password = function (email, role, key) {
    var password = $('#change_password').val();
    var confirm_password = $('#change_confirm_password').val();
    var submit = true;

    if (password == '') {
        $('#helper-error-login-recoverpw-password').text('*A password é obrigatória!');
        $('#change_password').addClass("input-valid");
        submit = false;
    } else if (password.length < 8) {
        $('#helper-error-login-recoverpw-password').text('A password necessita de ter pelo menos 8 caracteres');
        $('#change_password').addClass("input-valid");
    } else {
        $('#helper-error-login-recoverpw-password').text('');
        $('#change_password').removeClass("input-valid");
    }
    if (confirm_password == '') {
        $('#helper-error-login-recoverpw-confirm-password').text('*A confirmação da password é obrigatória!');
        $('#change_confirm_password').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-login-recoverpw-confirm-password').text('');
        $('#change_confirm_password').removeClass("input-valid");
    }

    if (password != confirm_password) {
        $('#helper-error-login-recoverpw-confirm-password').text('*As passwords não coincidem!');
        $('#change_confirm_password').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-login-recoverpw-confirm-password').text('');
        $('#change_confirm_password').removeClass("input-valid");
    }
    var strength = 0;
    var arr = [/.{8,}/, /[a-z]+/, /[0-9]+/, /[!@#$%^&*(),.?":{}|<>]+/, /[A-Z]+/];
    jQuery.map(arr, function (regexp) {
        if (password.match(regexp))
            strength++;
    });

    if (strength < 3) {
        $('#helper-error-login-recoverpw-password').text('A força da password necessita de ser pelo menos 60%');
        submit = false;
    }
    if (submit == true) {
        if (role == 0) {
            $.ajax({
                url: url + 'user/user.php?f=recover_pw',
                type: "POST",
                data: {email: email, role: role, key: key, password: password}
            }).done(function (changed) {
                if (changed == true) {
                    Swal({
                        type: 'success',
                        title: 'A sua password foi alterada!',
                        html: 'Irá ser redirecionado para a página principal.',
                        timer: 2000,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = url;
                        }
                    });
                } else {
                    Swal({
                        type: 'error',
                        title: 'Ocorreu um erro, a sua password não foi alterada!',
                        html: 'Irá ser redirecionado para a página principal.',
                        timer: 2000,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = url;
                        }
                    });
                }
            });
        } else {
            $.ajax({
                url: url + 'admin/admin.php?f=recover_pw',
                type: "POST",
                data: {email: email, role: role, key: key, password: password}
            }).done(function (changed) {
                if (changed == true) {
                    Swal({
                        type: 'success',
                        title: 'A sua password foi alterada!',
                        html: 'Irá ser redirecionado para a página principal.',
                        timer: 2000,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = url + 'admin';
                        }
                    });
                } else {
                    Swal({
                        type: 'error',
                        title: 'Ocorreu um erro, a sua password não foi alterada!',
                        html: 'Irá ser redirecionado para a página principal.',
                        timer: 2000,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = url + 'admin';
                        }
                    });
                }
            });
        }
    }
}
;
//-------------------------------------------------------------------------- SCRIPTS USERS --------------------------------------------------------------------------
logout = function () {
    window.location.href = 'https://voto-eletronico.jbr-projects.pt/user/user.php?f=logout_user';
};

$(window).on('load', function () {
    call_page_dashboard();
});


//FUNÇÃO PARA O SELECT DO LOGIN
$("#login_user_doc").change(function () {
    var selected_option = $('#login_user_doc').val();
    if (selected_option != null) {
        $('#div_login_user_nmri').css('display', 'block');
        $('#pw').css('display', 'block');
        $('#recover_password').css('display', 'block');
        $('#btn_next').prop("disabled", false);
    } else {
        $('#div_login_user_nmri').css('display', 'none');
    }
});
//APENAS NÚMEROS NO INPUT DO NIF E NUMERO DO ALUNO
function only_numbers(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

//FUNÇÃO AO CLICAR NO BOTAO DE RECUPERAR PASSWORD
$("#forget_password_user").click(function () {
    $('#login_user_second_div').remove();
    $('#login_user_total_div').append('<h2 style="color:#fff;">Recuperação da Password</h2>');
    $('#login_user_total_div').append('<div class="form-floating mb-3"><input class="form-control form-login" id="login_recoverpw_email" type="email" placeholder="Insira o seu Email"><label class="text-admin">Insira o seu Email</label><span class="helper-error" id="helper-error-login-recoverpw-email"></span></div><div class="d-flex justify-content-center"><button class="btn btn-first" onclick="generate_linkto_recover_password_user();"><i class="fas fa-envelope"></i>&nbsp;&nbsp;Enviar Email</button></div>');
});
//FUNÇÃO PARA GERAR O LINK PARA A RECUPERAÇÃO DA PASSWORD PARA OS USERS
generate_linkto_recover_password_user = function () {
    var email = $('#login_recoverpw_email').val();
    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var submit = true;
    if (email == '') {
        $('#helper-error-login-recoverpw-email').text('*O email é obrigatório!');
        $('#login_recoverpw_email').addClass("input-valid");
        submit = false;
    } else if (!testEmail.test(email)) {
        $('#helper-error-login-recoverpw-email').text('*O email introduzido não é valido!');
        $('#login_recoverpw_email').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-login-recoverpw-email').text('');
        $('#login_recoverpw_email').removeClass("input-valid");
    }
    if (submit == true) {
        $.ajax({
            url: 'user/user.php?f=send_email_recoverpw',
            type: "POST",
            data: {email: email}
        }).done(function (email_found) {
            if (email_found != true) {
                $('#helper-error-login-recoverpw-email').text('*O email introduzido não existe!');
            } else {
                Swal({
                    type: 'info',
                    title: 'O link para a recuperação da password foi enviada!',
                    html: 'Irá ser redirecionado para a página principal.',
                    timer: 2000,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = url;
                    }
                })
            }
        });
    }
};
//FUNÇÃO DE VERIFICAÇÃO DE UTILIZADOR
user_verify = function () {
    var submit = true;
    var selected_option = $('#login_user_doc').val();
    var login_user_password = $('#login_user_password').val();
    var login_user_nmri = $('#login_user_nmri').val();
    if (login_user_nmri == '') {
        $('#helper-error-login-user-nmri').text('*O Numero de Identificação é obrigatório!');
        $('#login_user_nmri').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-login-user-nmri').text('')
        $('#login_user_nmri').removeClass("input-valid");
    }
    if (login_user_password == '') {
        $('#helper-error-login-password').text('*A password é obrigatória!');
        $('#login_user_password').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-login-password').text('')
        $('#login_user_password').removeClass("input-valid");
    }
    if (submit == true) {
        $.ajax({
            url: 'user/user.php?f=verify_user',
            type: "POST",
            data: {user_document_type: selected_option, user_password: login_user_password, user_nmri: login_user_nmri}
        }).done(function (user_found) {
            if (user_found == true) {
                $('#login_user_second_div').remove();
                $('#login_user_total_div').append('<h2 class="d-flex justify-content-center" style="color:#fff;">Chave de Segurança</h2>');
                $('#login_user_total_div').append('<div class="d-flex justify-content-center"><div class="form-floating mb-3"><input class="form-control form-login" id="login_user_key" type="password" placeholder="Insira a sua chave de segurança"><label class="text-admin">Insira a sua chave de segurança</label><span class="helper-error" id="helper-error-key"></span></div></div><div class="d-flex justify-content-center"><a style="text-decoration: none;color: #fff;" id="resend_key" href="#" type="button">Não recebeu a chave? Clique aqui para reenviar a chave para o seu email</a></div><div class="d-flex justify-content-center"><button class="btn btn-first" onclick="user_login(\'' + selected_option + '\',\'' + login_user_password + '\',\'' + login_user_nmri + '\');"><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Entrar</button></div>');
                $("#resend_key").click(function () {
                    $("#small_first").remove();
                    $("#small_second").remove();
                    $('#login_user_total_div').append('<small id="small_second" style="color:#7d6110;">Recebeu a nova chave de acesso na caixa de entrada ou no SPAM do seu email </small>');
                    $.ajax({
                        url: 'user/user.php?f=resend_key',
                        type: "POST",
                        data: {user_document_type: selected_option, user_password: login_user_password, user_nmri: login_user_nmri}
                    });
                });
                $('#login_user_total_div').append('<small id="small_first" style="color:#7d6110;">Recebeu a chave de acesso na caixa de entrada ou no SPAM do seu email </small>');
            } else {
                window.location.href = url;
            }
        });
    }
};
//FUNÇÃO DE LOGIN DO UTILIZADOR
user_login = function (selected_option, login_user_password, login_user_nmri) {
    var submit = true;
    var login_user_key = $('#login_user_key').val();
    if (login_user_key == '') {
        $('#helper-error-key').text('*A chave é obrigatória!');
        $('#login_user_key').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-key').text('');
        $('#login_user_key').removeClass("input-valid");
    }
    if (submit == true) {
        $.ajax({
            url: 'user/user.php?f=login_user',
            type: "POST",
            data: {user_document_type: selected_option, user_password: login_user_password, user_nmri: login_user_nmri, user_key: login_user_key}
        }).done(function (user_logged) {
            if (user_logged == true) {
                Swal({
                    type: 'info',
                    title: 'Está a entrar na conta!',
                    html: 'Irá ser redirecionado para a página de votação.',
                    timer: 2000,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = url;
                    }
                })
            } else {
                window.location.href = url;
            }
        });
    }
};
//FUNÇÃO QUE VERIFICA SE O UTILIZADOR JÁ ALTEROU A SUA PASSWORD
$(document).ready(function () {
    if ($('#check_pw').val() == 0) {
        Swal({
            title: 'Insira uma nova Password',
            text: 'Insira uma nova password para aumentar a segurança da sua conta!',
            confirmButtonColor: '#1fb94b',
            allowOutsideClick: false,
            html:
                    '<input id="new_password" placeholder="Insira a nova password" type="password" class="swal2-input">' +
                    '<input id="confirm_new_password" placeholder="Insira novamente a nova password" type="password" class="swal2-input">',
            focusConfirm: false,
            preConfirm: () => {
                new_password = Swal.getPopup().querySelector('#new_password').value;
                confirm_new_password = Swal.getPopup().querySelector('#confirm_new_password').value;
                if (new_password != confirm_new_password) {
                    swal.showValidationError('As passwords não coincidem');
                }
                if (confirm_new_password == '') {
                    swal.showValidationError('A confirmação da nova password é obrigatório!');
                }
                if (new_password == '') {
                    swal.showValidationError('A password é obrigatória');
                }
                return {new_password: new_password, confirm_new_password: confirm_new_password}
            }
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'user/user.php?f=set_change_pw',
                    type: "POST",
                    data: {user_password: new_password}
                }).done(function (updated) {
                    if (updated != true) {
                        Swal({
                            position: 'bottom-end',
                            type: 'error',
                            title: 'Ocorreu um erro, a sua password não foi alterada',
                            toast: true,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else {
                        Swal({
                            position: 'bottom-end',
                            type: 'success',
                            title: 'A sua password foi alterada com sucesso',
                            toast: true,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                });
            }
        });
    }
});
//FUNÇÃO QUE MOSTRA TODOS OS CANDIDATOS DISPONIVEIS PARA VOTAR NUM DETERMINADO EVENTO
see_candidates_user_event = function (id) {
    var event_id = id;
    var html = '';
    $.ajax({
        url: 'user/user.php?f=get_candidates_event_fjson',
        type: "POST",
        data: {event_id: event_id}
    }).done(function (result_candidates_event) {
        var obj_candidates_event = JSON.parse(result_candidates_event); //RECEBE O OBJETO QUE FOI RETORNADO EM FORMATO JSON
        //FAZ UM CICLO AOS CANDIDATOS
        $.each(obj_candidates_event, function (i) {
            //VERIFICA SE ALGUM DOS CANDIDATOS DO EVENTO NÃO TEM NOME
            if (obj_candidates_event[i].candidate_name == '') {
                html += '<ul class="no-bullets"><li><input type="radio" name="candidate_name" value="' + obj_candidates_event[i].candidate_id + '">' + obj_candidates_event[i].candidate_entourage + '</li></ul>' + '<br>'
            } else {
                html += '<ul class="no-bullets"><li><input type="radio" name="candidate_name" value="' + obj_candidates_event[i].candidate_id + '">' + obj_candidates_event[i].candidate_name + '</li></ul>' + '<br>'
            }

        });
        Swal({
            title: '<strong>Vote no seu candidato favorito</strong>',
            html: html + '<ul class="no-bullets"><li><input type="radio" name="candidate_name" value="null">Voto em Branco</li></ul>',
            showCloseButton: false,
            confirmButtonColor: '#1fb94b',
            showConfirmButton: true,
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: '<i class="fas fa-vote-yea"></i>&nbsp;&nbsp;Confirmar Voto',
            cancelButtonText: '<i class="fa fa-close"></i>',
            customClass: 'candidates_scroll',
            preConfirm: () => {
                candidate_selected = Swal.getPopup().querySelector('input[name=candidate_name]:checked').value;
                return {candidate_selected: candidate_selected}
            }
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'user/user.php?f=save_vote',
                    type: "POST",
                    data: {candidate_id: candidate_selected, event_id: event_id}
                }).done(function (inserted) {
                    if (inserted != true) {
                        Swal({
                            position: 'bottom-end',
                            type: 'error',
                            title: 'Ocorreu um erro, não foi possivel confirmar o seu voto',
                            toast: true,
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.href = url;
                            }
                        })
                    } else {
                        Swal({
                            position: 'bottom-end',
                            type: 'success',
                            title: 'O seu voto foi confirmado com sucesso',
                            toast: true,
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.href = url;
                            }
                        })
                    }
                });
            }
        });
    });
};
//FUNÇÃO QUE VAI BUSCAR OS RESULTADOS DE UM DETERMINADO EVENTO
see_results_event = function (event_id) {
    $.ajax({
        url: 'user/user.php?f=see_results',
        type: "POST",
        data: {event_id: event_id}
    }).done(function (table) {
        if (table != '') {
            Swal({
                title: 'Resultados do evento ' + event_id,
                type: 'info',
                html: table,
                showConfirmButton: false,
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonColor: '#d33',
                cancelButtonText: '<i class="fa fa-close"></i>',
                customClass: 'candidates_scroll'
            });
        } else {

        }
    });
};

verify_user_password = function () {
    var user_password = $('#user_password').val();
    $.ajax({
        url: 'user/user.php?f=verify_pw_user',
        type: "POST",
        data: {user_password: user_password}
    }).done(function (exists) {
        if (exists) {
            $('#user_password').removeClass("input-valid");
            $('#helper-error-change-user-password').text('');
            $('#helper-success-change-user-password').text('*A password que introduziu está correta!');
            $("#user_password").prop('disabled', true);
            $("#btn-verify-user-password").prop('disabled', true);
            $("#user_new_password").prop('disabled', false);
            $("#user_confirm_new_password").prop('disabled', false);
            $("#btn-change-user-password").prop('disabled', false);
        } else {
            $('#helper-error-change-user-password').text('*A password que introduziu não está correta!');
            $('#user_password').addClass("input-valid");
        }
    });
};

change_password = function () {
    var user_new_password = $('#user_new_password').val();
    var user_confirm_new_password = $('#user_confirm_new_password').val();
    var submit = true;

    var strength = 0;
    var arr = [/.{8,}/, /[a-z]+/, /[0-9]+/, /[!@#$%^&*(),.?":{}|<>]+/, /[A-Z]+/];
    jQuery.map(arr, function (regexp) {
        if (user_new_password.match(regexp))
            strength++;
    });

    if (user_new_password == '') {
        $('#helper-error-user-new-password').text('*A password é obrigatória!');
        $('#user_new_password').addClass("input-valid");
        submit = false;
    } else if (user_new_password.length < 8) {
        $('#helper-error-user-new-password').text('A password necessita de ter pelo menos 8 caracteres');
        $('#user_new_password').addClass("input-valid");
        submit = false;
    } else if (strength < 3) {
        $('#helper-error-user-new-password').text('A força da password necessita de ser pelo menos 60%');
        submit = false;
    } else {
        $('#helper-error-user-new-password').text('');
        $('#user_new_password').removeClass("input-valid");
    }
    if (user_confirm_new_password == '') {
        $('#helper-error-user-confirm-new-password').text('*A confirmação da password é obrigatória!');
        $('#user_confirm_new_password').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-user-confirm-new-password').text('');
        $('#user_confirm_new_password').removeClass("input-valid");
    }

    if (user_new_password != user_confirm_new_password) {
        $('#helper-error-user-confirm-new-password').text('*As passwords não coincidem!');
        $('#user_confirm_new_password').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-user-confirm-new-password').text('');
        $('#user_confirm_new_password').removeClass("input-valid");
    }

    if (submit) {
        $.ajax({
            url: 'user/user.php?f=user_new_password',
            type: "POST",
            data: {user_new_password: user_new_password}
        }).done(function (updated) {
            if (updated != true) {
                Swal({
                    position: 'bottom-end',
                    type: 'error',
                    title: 'Ocorreu um erro, a sua password não foi alterada',
                    toast: true,
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = url;
                    }
                })
            } else {
                Swal({
                    position: 'bottom-end',
                    type: 'success',
                    title: 'A sua password foi alterada com sucesso',
                    toast: true,
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = url;
                    }
                })
            }
        });
    }

};
//-------------------------------------------------------------------------- SCRIPTS ADMINS --------------------------------------------------------------------------

$(document).ready(function () {
    $('#dtb_tipos_de_documento').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ resultados",
            "zeroRecords": "Não foram encontrados tipos de documento",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Não foram encontrados tipos de documento",
            "infoFiltered": "(filtrado em _MAX_ resultados)",
            "search": "Pesquisa:",
            "paginate": {
                "first": "Primeira",
                "last": "Última",
                "next": "Seguinte",
                "previous": "Anterior"
            }
        }
    });
    $('#dtb_utilizadores').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ resultados",
            "zeroRecords": "Não foram encontrados utilizadores",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Não foram encontrados utilizadores",
            "infoFiltered": "(filtrado em _MAX_ resultados)",
            "search": "Pesquisa:",
            "paginate": {
                "first": "Primeira",
                "last": "Última",
                "next": "Seguinte",
                "previous": "Anterior"
            }
        }
    });
    $('#dtb_eventos').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ resultados",
            "zeroRecords": "Não foram encontrados eventos",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Não foram encontrados eventos",
            "infoFiltered": "(filtrado em _MAX_ resultados)",
            "search": "Pesquisa:",
            "paginate": {
                "first": "Primeira",
                "last": "Última",
                "next": "Seguinte",
                "previous": "Anterior"
            }
        }
    });
    $('#dtb_candidatos').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ resultados",
            "zeroRecords": "Não foram encontrados candidatos",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Não foram encontrados candidatos",
            "infoFiltered": "(filtrado em _MAX_ resultados)",
            "search": "Pesquisa:",
            "paginate": {
                "first": "Primeira",
                "last": "Última",
                "next": "Seguinte",
                "previous": "Anterior"
            }
        }
    });
});
//FUNÇÃO DE LOGIN DE ADMIN
admin_login = function () {
    var submit = true;
    var admin_email = $('#admin_email').val();
    var admin_password = $('#admin_password').val();
    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if (admin_email == '') {
        $('#helper-error-admin-email').text('*O email do administrador é obrigatório!');
        $('#admin_email').addClass("input-valid");
        submit = false;
    } else if (!testEmail.test(admin_email)) {
        $('#helper-error-admin-email').text('*O email do administrador introduzido não é valido!');
        $('#admin_email').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-admin-email').text('');
        $('#admin_email').removeClass("input-valid");
    }

    if (admin_password == '') {
        $('#helper-error-admin-password').text('*A password do administrador é obrigatória!');
        $('#admin_password').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-admin-password').text('');
        $('#admin_password').removeClass("input-valid");
    }
    if (submit == true) {
        $.ajax({
            url: 'admin.php?f=login_admin',
            type: "POST",
            data: {admin_email: admin_email, admin_password: admin_password}
        }).done(function (admin_logged) {
            if (admin_logged == true) {
                Swal({
                    type: 'info',
                    title: 'Está a entrar na conta!',
                    html: 'Irá ser redirecionado para a página de administração.',
                    timer: 2000,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = url + "admin/";
                    }
                })
            } else {
                window.location.href = url + "admin/";
            }
        });
    }
}

//FUNÇÃO PARA O SELECT DA INSERÇÃO DO UTILIZADOR
$("#add_user_doc").change(function () {
    var selected_option = $('#add_user_doc').val();
    if (selected_option != null) {
        $('#div_add_user_nmri').css('display', 'block');
    } else {
        $('#div_add_user_nmri').css('display', 'none');
    }
});
//FUNÇÃO AO CLICAR NO BOTAO DE RECUPERAR PASSWORD
$("#forget_password_admin").click(function () {
    $('#login_admin_second_div').remove();
    $('#login_admin_total_div').append('<h2 style="color:#fff;">Recuperação da password</h2>');
    $('#login_admin_total_div').append('<div class="form-floating mb-3"><input class="form-control form-login" id="login_recoverpw_email_admin" type="email" placeholder="Insira o seu Email"><label class="text-admin">Insira o seu Email</label><span class="helper-error" id="helper-error-login-recoverpw-email-admin"></span></div><div class="d-flex justify-content-center"><button class="btn btn-first" onclick="generate_linkto_recover_password_admin();"><i class="fas fa-envelope"></i>&nbsp;&nbsp;Enviar Email</button></div>');
});


//FUNÇÃO PARA GERAR O LINK PARA A RECUPERAÇÃO DA PASSWORD PARA OS USERS
generate_linkto_recover_password_admin = function () {
    var email = $('#login_recoverpw_email_admin').val();
    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var submit = true;
    if (email == '') {
        $('#helper-error-login-recoverpw-email-admin').text('*O email é obrigatório!');
        $('#login_recoverpw_email_admin').addClass('input-valid');
        submit = false;
    } else if (!testEmail.test(email)) {
        $('#helper-error-login-recoverpw-email-admin').text('*O email introduzido não é valido!');
        $('#login_recoverpw_email_admin').addClass('input-valid');
        submit = false;
    } else {
        $('#helper-error-login-recoverpw-email-admin').text('');
        $('#login_recoverpw_email_admin').removeClass('input-valid');
    }
    if (submit == true) {
        $.ajax({
            url: 'admin.php?f=send_email_recoverpw',
            type: "POST",
            data: {email: email}
        }).done(function (email_found) {
            if (email_found != true) {
                $('#helper-error-login-recoverpw-email-admin').text('*O email introduzido não existe!');
                $('#login_recoverpw_email_admin').addClass('input-valid');
            } else {
                $('#login_recoverpw_email_admin').removeClass('input-valid');
                Swal({
                    type: 'info',
                    title: 'O link para a recuperação da password foi enviada!',
                    html: 'Irá ser redirecionado para a página principal.',
                    timer: 2000,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = url;
                    }
                })
            }
        });
    }
};

//FUNÇÃO PARA INSERIR NOVO UTILIZADOR
add_user = function () {
    var submit = true;
    var add_user_name = $('#add_user_name').val();
    var add_user_email = $('#add_user_email').val();
    var add_user_password = $('#add_user_password').val();
    var add_user_confirm_password = $('#add_user_confirm_password').val();
    var selected_option = $('#add_user_doc').val();
    var add_user_nmri = $('#add_user_nmri').val();
    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var temErro = 0;
    if (add_user_name == '') {
        $('#helper-error-add-user-name').text('*O Nome do utilizador é obrigatório!');
        $('#add_user_name').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-add-user-name').text('');
        $('#add_user_name').removeClass("input-valid");
    }

    if (add_user_email == '') {
        $('#helper-error-add-user-email').text('*O Email do utilizador é obrigatório!');
        $('#add_user_email').addClass("input-valid");
        submit = false;
    } else if (!testEmail.test(add_user_email)) {
        $('#helper-error-add-user-email').text('*O Email do utilizador introduzido não é valido!');
        $('#add_user_email').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-add-user-email').text('');
        $('#add_user_email').removeClass("input-valid");
    }

    var strength = 0;
    var arr = [/.{8,}/, /[a-z]+/, /[0-9]+/, /[!@#$%^&*(),.?":{}|<>]+/, /[A-Z]+/];
    jQuery.map(arr, function (regexp) {
        if (add_user_password.match(regexp))
            strength++;
    });

    if (add_user_password == '') {
        $('#helper-error-add-user-password').text('*A password do utilizador é obrigatória!');
        $('#add_user_password').addClass("input-valid");
        submit = false;
    } else if (add_user_password.length < 8) {
        $('#helper-error-add-user-password').text('A password necessita de ter pelo menos 8 caracteres');
        $('#add_user_password').addClass("input-valid");
        submit = false;
    } else if (strength < 3) {
        $('#helper-error-add-user-password').text('A força da password necessita de ser pelo menos 60%');
        $('#add_user_password').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-add-user-password').text('');
        $('#add_user_password').removeClass("input-valid");
    }

    if (add_user_password != add_user_confirm_password) {
        $('#helper-error-add-user-confirm-password').text('*As passwords introduzidas não coincidem!');
        $('#add_user_confirm_password').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-add-user-confirm-password').text('');
        $('#add_user_confirm_password').removeClass("input-valid");
    }
    if (selected_option == null) {
        $('#helper-error-add-user-doc_type').text('*O tipo de documento do utilizador é obrigatório');
        $('#add_user_doc').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-add-user-doc_type').text('');
        $('#add_user_doc').removeClass("input-valid");
    }

    if (add_user_nmri == '') {
        $('#helper-error-add-user-nmri').text('*O número de identificação do utilizador é obrigatório!');
        $('#add_user_nmri').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-add-user-nmri').text('');
        $('#add_user_nmri').removeClass("input-valid");
    }

    if (submit == true) {
        $.ajax({
            url: 'admin.php?f=add_user',
            type: "POST",
            data: {add_user_name: add_user_name, add_user_email: add_user_email, add_user_password: add_user_password, add_user_doc: selected_option, add_user_nmri: add_user_nmri}
        }).done(function (user_registed) {
            if (user_registed == true) {
                Swal({
                    position: 'bottom-end',
                    type: 'error',
                    title: 'Utilizador já existe, logo não foi possivel adicioná-lo',
                    toast: true,
                    showConfirmButton: false,
                    timer: 2000
                })
                call_page_add_user();
            } else {
                Swal({
                    position: 'bottom-end',
                    type: 'success',
                    title: 'Utilizador adicionado com sucesso',
                    toast: true,
                    showConfirmButton: false,
                    timer: 2000
                })
                call_page_add_user();
            }
        });
    }
}

//FUNÇÃO PARA INSERIR NOVO EVENTO
add_event = function () {
    var add_event_title = $('#add_event_title').val();
    var add_event_description = $('#add_event_description').val();
    var add_event_date_ini = $('#add_event_date_ini').val();
    var add_event_date_exp = $('#add_event_date_exp').val();
    var selected_option = $('#add_event_doc').val();
    var submit = true;
    var today = new Date();
    if (today.getMonth() + 1 < 10) {
        if (today.getDate() < 10) {
            var date_string = today.getFullYear() + "-0" + (today.getUTCMonth() + 1) + "-0" + today.getDate();
        } else {
            var date_string = today.getFullYear() + "-0" + (today.getUTCMonth() + 1) + "-" + today.getDate();
        }
    } else {
        if (today.getDate() < 10) {
            var date_string = today.getFullYear() + "-" + (today.getUTCMonth() + 1) + "-0" + today.getDate();
        } else {
            var date_string = today.getFullYear() + "-" + (today.getUTCMonth() + 1) + "-" + today.getDate();
        }
    }
    if (add_event_title == '') {
        $('#helper-error-add-event-title').text('*O titulo do evento é obrigatório');
        $('#add_event_title').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-add-event-title').text('');
        $('#add_event_title').removeClass("input-valid");
    }
    if (add_event_date_ini == '') {
        $('#helper-error-add-event-date-ini').text('*A data inicial do evento é obrigatória');
        $('#add_event_date_ini').addClass("input-valid");
        submit = false;
    } else if (add_event_date_ini < date_string) {
        $('#helper-error-add-event-date-ini').text('*A data inicial não pode ser anterior à data atual');
        $('#add_event_date_ini').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-add-event-date-ini').text('');
        $('#add_event_date_ini').removeClass("input-valid");
    }
    if (add_event_date_exp == '') {
        $('#helper-error-add-event-date-exp').text('*A data de expiração do evento é obrigatória');
        $('#add_event_date_exp').addClass("input-valid");
        submit = false;
    } else if (add_event_date_exp < add_event_date_ini) {
        $('#helper-error-add-event-date-exp').text('*A data de expiração não pode ser anterior à data inicial');
        $('#add_event_date_exp').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-add-event-date-exp').text('');
        $('#add_event_date_exp').removeClass("input-valid");
    }
    if (selected_option == null) {
        $('#helper-error-add-event-doc_type').text('*O tipo de documento do evento é obrigatório');
        $('#add_event_doc').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-add-event-doc_type').text('');
        $('#add_event_doc').removeClass("input-valid");
    }
    if (submit == true) {
        $.ajax({
            url: 'admin.php?f=add_event',
            type: "POST",
            data: {add_event_title: add_event_title, add_event_description: add_event_description, add_event_date_ini: add_event_date_ini, add_event_date_exp: add_event_date_exp, add_event_doc: selected_option}
        }).done(function (added) {
            if (added != true) {
                Swal({
                    position: 'bottom-end',
                    type: 'error',
                    title: 'Ocorreu um erro, o evento não foi adicionado',
                    toast: true,
                    showConfirmButton: false,
                    timer: 2000
                })
                call_page_add_event();
            } else {
                Swal({
                    position: 'bottom-end',
                    type: 'success',
                    title: 'Evento adicionado com sucesso',
                    toast: true,
                    showConfirmButton: false,
                    timer: 2000
                })
                call_page_add_event();
            }
        });
    }

}

//FUNÇÃO PARA INSERIR NOVO CANDIDATO
add_candidate = function () {
    var add_candidate_name = $('#add_candidate_name').val();
    var add_candidate_entourage = $('#add_candidate_entourage').val();
    var submit = true;
    if (add_candidate_name == '' && add_candidate_entourage == '') {
        $('#helper-error-add-candidate').text('*Uma das duas opções é obrigatório preencher');
        $('#add_candidate_name').addClass("input-valid");
        $('#add_candidate_entourage').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-add-candidate').text('');
        $('#add_candidate_name').removeClass("input-valid");
        $('#add_candidate_entourage').removeClass("input-valid");
    }
    if (submit == true) {
        $.ajax({
            url: 'admin.php?f=add_candidate',
            type: "POST",
            data: {add_candidate_name: add_candidate_name, add_candidate_entourage: add_candidate_entourage}
        }).done(function (added) {
            if (added != true) {
                Swal({
                    position: 'bottom-end',
                    type: 'error',
                    title: 'Ocorreu um erro, o candidato não foi adicionado',
                    toast: true,
                    showConfirmButton: false,
                    timer: 2000
                })
                call_page_add_candidate();
            } else {
                Swal({
                    position: 'bottom-end',
                    type: 'success',
                    title: 'Candidato adicionado com sucesso',
                    toast: true,
                    showConfirmButton: false,
                    timer: 2000
                })
                call_page_add_candidate();
            }
        });
    }

}

//FUNÇÃO PARA INSERIR NOVO TIPO DE DOCUMENTO
add_doc = function () {
    var add_document_name = $('#add_document_name').val();
    var submit = true;
    if (add_document_name == '') {
        $('#helper-error-add-document-name').text('*O nome do tipo de documento é obrigatório');
        $('#add_document_name').addClass("input-valid");
        submit = false;
    } else {
        $('#helper-error-add-document-name').text('');
        $('#add_document_name').removeClass("input-valid");
    }
    if (submit == true) {
        $.ajax({
            url: 'admin.php?f=add_document_type',
            type: "POST",
            data: {add_document_name: add_document_name}
        }).done(function (added) {
            if (added != true) {
                Swal({
                    position: 'bottom-end',
                    type: 'error',
                    title: 'Ocorreu um erro, o tipo de documento não foi adicionado',
                    toast: true,
                    showConfirmButton: false,
                    timer: 2000
                })
                call_page_add_document();
            } else {
                Swal({
                    position: 'bottom-end',
                    type: 'success',
                    title: 'Tipo de Documento adicionado com sucesso',
                    toast: true,
                    showConfirmButton: false,
                    timer: 2000
                })
                call_page_add_document();
            }
        });
    }

}

//FUNÇÃO PARA ELIMINAR UM UTILIZADOR
delete_user = function (id) {
    var user_id = id;
    swal({
        title: 'Eliminar Utilizador ' + user_id,
        text: "Não será possivel reverter esta ação",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1fb94b',
        cancelButtonColor: '#d33',
        confirmButtonText: '<i class="fas fa-trash"></i>&nbsp;&nbsp;Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: 'admin.php?f=delete_user',
                type: "POST",
                data: {user_id: user_id}
            }).done(function (user_deleted) {
                if (user_deleted == true) {
                    Swal({
                        position: 'bottom-end',
                        type: 'success',
                        title: 'Utilizador eliminado com sucesso',
                        toast: true,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    call_page_see_users();
                } else {
                    Swal({
                        position: 'bottom-end',
                        type: 'error',
                        title: 'Ocorreu um erro ao tentar eliminar o utilizador ' + user_id,
                        toast: true,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    call_page_see_users();
                }
            });
        }
    }
    );
}

//FUNÇÃO PARA ELIMINAR UM EVENTO
delete_event = function (id) {
    var event_id = id;
    swal({
        title: 'Eliminar Evento ' + event_id,
        text: "Não será possivel reverter esta ação",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1fb94b',
        cancelButtonColor: '#d33',
        confirmButtonText: '<i class="fas fa-trash"></i>&nbsp;&nbsp;Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: 'admin.php?f=delete_event',
                type: "POST",
                data: {event_id: event_id}
            }).done(function (event_deleted) {
                if (event_deleted == true) {
                    Swal({
                        position: 'bottom-end',
                        type: 'success',
                        title: 'Evento eliminado com sucesso',
                        toast: true,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    call_page_see_events();
                } else {
                    Swal({
                        position: 'bottom-end',
                        type: 'error',
                        title: 'Ocorreu um erro ao tentar eliminar o evento ' + event_id,
                        toast: true,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    call_page_see_events();
                }
            });
        }
    }
    );
}

//FUNÇÃO PARA ELIMINAR UM CANDIDATO
delete_candidate = function (id) {
    var candidate_id = id;
    swal({
        title: 'Eliminar Candidato ' + candidate_id,
        text: "Não será possivel reverter esta ação",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1fb94b',
        cancelButtonColor: '#d33',
        confirmButtonText: '<i class="fas fa-trash"></i>&nbsp;&nbsp;Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: 'admin.php?f=delete_candidate',
                type: "POST",
                data: {candidate_id: candidate_id}
            }).done(function (candidate_deleted) {
                if (candidate_deleted == true) {
                    Swal({
                        position: 'bottom-end',
                        type: 'success',
                        title: 'Candidato eliminado com sucesso',
                        toast: true,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    call_page_see_candidates();
                } else {
                    Swal({
                        position: 'bottom-end',
                        type: 'error',
                        title: 'Ocorreu um erro ao tentar eliminar o candidato ' + candidate_id,
                        toast: true,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    call_page_see_candidates();
                }
            });
        }
    }
    );
}

//FUNÇÃO PARA ELIMINAR UM TIPO DE DOCUMENTO
delete_document_type = function (id) {
    var doc_id = id;
    swal({
        title: 'Eliminar Tipo de Documento ' + doc_id,
        text: "Não será possivel reverter esta ação",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#1fb94b',
        cancelButtonColor: '#d33',
        confirmButtonText: '<i class="fas fa-trash"></i>&nbsp;&nbsp;Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: 'admin.php?f=delete_doc',
                type: "POST",
                data: {doc_id: doc_id}
            }).done(function (doc_deleted) {
                if (doc_deleted == true) {
                    Swal({
                        position: 'bottom-end',
                        type: 'success',
                        title: 'Tipo de Documento eliminado com sucesso',
                        toast: true,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    call_page_see_documents();
                } else {
                    Swal({
                        position: 'bottom-end',
                        type: 'error',
                        title: 'Ocorreu um erro ao tentar eliminar o tipo de documento ' + doc_id,
                        toast: true,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    call_page_see_documents();
                }
            });
        }
    }
    );
}

//FUNÇÃO PARA EDITAR UM UTILZADOR
edit_user = function (id) {
    var user_id = id;
    var options = '';
    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    $.ajax({
        url: 'admin.php?f=get_specific_user',
        type: "POST",
        data: {user_id: user_id}
    }).done(function (result_users) {
        var obj_users = JSON.parse(result_users); //RECEBE O OBJETO QUE FOI RETORNADO EM FORMATO JSON
        $.ajax({
            url: 'admin.php?f=get_docs_fjson',
            type: "POST",
            data: {user_id: user_id}
        }).done(function (result_docs) {
            var obj_docs = JSON.parse(result_docs); //RECEBE O OBJETO QUE FOI RETORNADO EM FORMATO JSON
            //FAZ UM CICLO AOS DOCUMENTOS 
            $.each(obj_docs, function (i) {
                //VERIFICA SE O TIPO DE DOCUMENTO É IGUAL AO TIPO DE DOCUMENTO DO UTILIZADOR
                if (obj_docs[i].doc_id == obj_users.user_doc_id) {
                    options += '<option selected value="' + obj_docs[i].doc_id + '">' + obj_docs[i].doc_name + '</option>';
                } else {
                    options += '<option value="' + obj_docs[i].doc_id + '">' + obj_docs[i].doc_name + '</option>';
                }
            });
            Swal({
                title: 'Editar Utilizador ' + user_id,
                showCancelButton: true,
                confirmButtonColor: '#1fb94b',
                cancelButtonColor: '#d33',
                confirmButtonText: '<i class="fas fa-user-edit"></i>&nbsp;&nbsp;Alterar',
                cancelButtonText: 'Cancelar',
                html:
                        '<label style="float:left;">Nome do Utilizador: </label>' +
                        '<input value="' + obj_users.user_name + '" id="edit_user_name" class="swal2-input">' +
                        '<label style="float:left;">Email do Utilizador: </label>' +
                        '<input value="' + obj_users.user_email + '" id="edit_user_email" class="swal2-input">' +
                        '<label style="float:left;">Documento do Utilizador: </label>' +
                        '<select name="add_user_doc" id="edit_user_doc" class="swal2-input"> ' +
                        '<option disabled>Selecione uma opção</option>' + options +
                        '</select>' +
                        '<label style="float:left;">Número de Identificação do Utilizador: </label>' +
                        '<input value="' + obj_users.user_nmri + '" id="edit_user_nmri" maxlength="11" onkeypress="return only_numbers(event)" class="swal2-input">',
                focusConfirm: false,
                preConfirm: () => {
                    user_name = Swal.getPopup().querySelector('#edit_user_name').value;
                    user_email = Swal.getPopup().querySelector('#edit_user_email').value;
                    doc_id = Swal.getPopup().querySelector('#edit_user_doc').value;
                    user_nmri = Swal.getPopup().querySelector('#edit_user_nmri').value;
                    if (user_name == '') {
                        swal.showValidationError('O nome do utilizador é obrigatório');
                    }
                    if (user_email == '') {
                        swal.showValidationError('O Email do utilizador é obrigatório!');
                    }
                    if (!testEmail.test(user_email)) {
                        swal.showValidationError('O Email do utilizador introduzido não é válido!');
                    }

                    if (doc_id == '') {
                        swal.showValidationError('O Tipo de documento do utilizador introduzido é obrigatório!');
                    }

                    if (user_nmri == '') {
                        swal.showValidationError('O número de identificação do utilizador é obrigatório!');
                    }
                    return {user_name: user_name, user_email: user_email, doc_id: doc_id, user_nmri: user_nmri}
                }
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'admin.php?f=edit_user',
                        type: "POST",
                        data: {user_id: user_id, user_name: user_name, user_email: user_email, doc_id: doc_id, user_nmri: user_nmri}
                    }).done(function (updated) {
                        if (updated != true) {
                            Swal({
                                position: 'bottom-end',
                                type: 'error',
                                title: 'Ocorreu um erro, o utilizador não foi alterado',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000
                            })
                            call_page_see_users();
                        } else {
                            Swal({
                                position: 'bottom-end',
                                type: 'success',
                                title: 'O utilizador foi alterado com sucesso',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000
                            })
                            call_page_see_users();
                        }
                    });
                }
            });
        });
    });
}

//FUNÇÃO PARA EDITAR UM EVENTO
edit_event = function (id) {
    var event_id = id;
    var options = '';
    var today = new Date();
    if (today.getMonth() + 1 < 10) {
        if (today.getDate() < 10) {
            var date_string = today.getFullYear() + "-0" + (today.getUTCMonth() + 1) + "-0" + today.getDate();
        } else {
            var date_string = today.getFullYear() + "-0" + (today.getUTCMonth() + 1) + "-" + today.getDate();
        }
    } else {
        if (today.getDate() < 10) {
            var date_string = today.getFullYear() + "-" + (today.getUTCMonth() + 1) + "-0" + today.getDate();
        } else {
            var date_string = today.getFullYear() + "-" + (today.getUTCMonth() + 1) + "-" + today.getDate();
        }
    }
    $.ajax({
        url: 'admin.php?f=get_specific_event',
        type: "POST",
        data: {event_id: event_id}
    }).done(function (result_events) {
        var obj_events = JSON.parse(result_events); //RECEBE O OBJETO QUE FOI RETORNADO EM FORMATO JSON
        $.ajax({
            url: 'admin.php?f=get_docs_fjson',
            type: "POST",
            data: {event_id: event_id}
        }).done(function (result_docs) {
            var obj_docs = JSON.parse(result_docs); //RECEBE O OBJETO QUE FOI RETORNADO EM FORMATO JSON
            //FAZ UM CICLO AOS DOCUMENTOS         
            $.each(obj_docs, function (i) {
                //VERIFICA SE O TIPO DE DOCUMENTO É IGUAL AO TIPO DE DOCUMENTO DO EVENTO
                if (obj_docs[i].doc_id == obj_events.event_doc_id) {
                    options += '<option selected value="' + obj_docs[i].doc_id + '">' + obj_docs[i].doc_name + '</option>';
                } else {
                    options += '<option value="' + obj_docs[i].doc_id + '">' + obj_docs[i].doc_name + '</option>';
                }
            });
            Swal({
                title: 'Editar Evento ' + event_id,
                showCancelButton: true,
                confirmButtonColor: '#1fb94b',
                cancelButtonColor: '#d33',
                confirmButtonText: '<i class="fas fa-edit"></i>&nbsp;&nbsp;Alterar',
                cancelButtonText: 'Cancelar',
                html:
                        '<label style="float:left;">Título do Evento: </label>' +
                        '<input value="' + obj_events.event_title + '" id="edit_event_title" class="swal2-input">' +
                        '<label style="float:left;">Descrição do Evento: </label>' +
                        '<input value="' + obj_events.event_description + '" id="edit_event_description" class="swal2-input">' +
                        '<label style="float:left;">Data Inicial do Evento: </label>' +
                        '<input value="' + obj_events.event_date_ini + '" id="edit_event_date_ini" class="swal2-input" type="date">' +
                        '<label style="float:left;">Data de Expiração do Evento: </label>' +
                        '<input value="' + obj_events.event_date_exp + '" id="edit_event_date_exp" class="swal2-input" type="date">' +
                        '<label style="float:left;">Documento do Evento: </label>' +
                        '<select name="add_user_doc" id="edit_event_doc" class="swal2-input"> ' +
                        '<option disabled>Selecione uma opção</option>' + options +
                        '</select>',
                focusConfirm: false,
                preConfirm: () => {
                    event_title = Swal.getPopup().querySelector('#edit_event_title').value;
                    event_description = Swal.getPopup().querySelector('#edit_event_description').value;
                    event_date_ini = Swal.getPopup().querySelector('#edit_event_date_ini').value;
                    event_date_exp = Swal.getPopup().querySelector('#edit_event_date_exp').value;
                    doc_id = Swal.getPopup().querySelector('#edit_event_doc').value;
                    if (event_title == '') {
                        swal.showValidationError('O titulo do evento é obrigatório');
                    }
                    if (event_date_ini == '') {
                        swal.showValidationError('A data inicial do evento é obrigatório');
                    }
                    if (event_date_ini < obj_events.event_date_ini) {
                        if (event_date_ini < date_string) {
                            swal.showValidationError('A data inicial não pode ser anterior à data atual');
                        }
                    }
                    if (event_date_exp == '') {
                        swal.showValidationError('A data final do evento é obrigatório');
                    }
                    if (event_date_exp < event_date_ini) {
                        swal.showValidationError('A data de expiração não pode ser anterior à data inicial');
                    }
                    if (doc_id == '') {
                        swal.showValidationError('O Tipo de documento do evento introduzido é obrigatório!');
                    }
                    return {event_title: event_title, event_description: event_description, event_date_ini: event_date_ini, event_date_exp: event_date_exp, doc_id: doc_id}
                }
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'admin.php?f=edit_event',
                        type: "POST",
                        data: {event_id: event_id, event_title: event_title, event_description: event_description, event_date_ini: event_date_ini, event_date_exp: event_date_exp, doc_id: doc_id}
                    }).done(function (updated) {
                        if (updated != true) {
                            Swal({
                                position: 'bottom-end',
                                type: 'error',
                                title: 'Ocorreu um erro, o evento não foi alterado',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000
                            })
                            call_page_see_events();
                        } else {
                            Swal({
                                position: 'bottom-end',
                                type: 'success',
                                title: 'O evento foi alterado com sucesso',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000
                            })
                            call_page_see_events();
                        }
                    });
                }
            });
        });
    });
}

//FUNÇÃO PARA EDITAR UM CANDIDATO
edit_candidate = function (id) {
    var candidate_id = id;
    var candidate_name = '';
    var candidate_entourage = '';
    $.ajax({
        url: 'admin.php?f=get_specific_candidate',
        type: "POST",
        data: {candidate_id: candidate_id}
    }).done(function (result_candidates) {
        var obj = JSON.parse(result_candidates); //RECEBE O OBJETO QUE FOI RETORNADO EM FORMATO JSON
        Swal({
            title: 'Editar Candidato ' + candidate_id,
            showCancelButton: true,
            confirmButtonColor: '#1fb94b',
            cancelButtonColor: '#d33',
            confirmButtonText: '<i class="fas fa-edit"></i>&nbsp;&nbsp;Alterar',
            cancelButtonText: 'Cancelar',
            html:
                    '<label style="float:left;">Nome do Candidato: </label>' +
                    '<input value="' + obj.candidate_name + '" id="edit_candidate_name" class="swal2-input">' +
                    '<label style="float:left;">Partido do Candidato: </label>' +
                    '<input value="' + obj.candidate_entourage + '" id="edit_candidate_entourage" class="swal2-input">' +
                    '<span class="helper-error" id="helper-error-edit-candidate"></span>',
            focusConfirm: false,
            preConfirm: () => {
                candidate_name = Swal.getPopup().querySelector('#edit_candidate_name').value;
                candidate_entourage = Swal.getPopup().querySelector('#edit_candidate_entourage').value;
                if (candidate_name == '' && candidate_entourage == '') {
                    swal.showValidationError('Uma das duas opções é obrigatório preencher.');
                }
                return {candidate_name: candidate_name, candidate_entourage: candidate_entourage}
            }
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'admin.php?f=edit_candidate',
                    type: "POST",
                    data: {candidate_id: candidate_id, candidate_name: candidate_name, candidate_entourage: candidate_entourage}
                }).done(function (updated) {
                    if (updated != true) {
                        Swal({
                            position: 'bottom-end',
                            type: 'error',
                            title: 'Ocorreu um erro, o candidato não foi alterado',
                            toast: true,
                            showConfirmButton: false,
                            timer: 2000
                        })
                        call_page_see_candidates();
                    } else {
                        Swal({
                            position: 'bottom-end',
                            type: 'success',
                            title: 'O candidato foi alterado com sucesso',
                            toast: true,
                            showConfirmButton: false,
                            timer: 2000
                        })
                        call_page_see_candidates();
                    }
                });
            }
        });
    });
}

//FUNÇÃO PARA EDITAR UM TIPO DE DOCUMENTO
edit_document = function (id) {
    var doc_id = id;
    var doc_name = '';
    $.ajax({
        url: 'admin.php?f=get_specific_document',
        type: "POST",
        data: {doc_id: doc_id}
    }).done(function (result_documents) {
        var obj = JSON.parse(result_documents); //RECEBE O OBJETO QUE FOI RETORNADO EM FORMATO JSON
        Swal({
            title: 'Editar Documento ' + doc_id,
            showCancelButton: true,
            confirmButtonColor: '#1fb94b',
            cancelButtonColor: '#d33',
            confirmButtonText: '<i class="fas fa-edit"></i>&nbsp;&nbsp;Alterar',
            cancelButtonText: 'Cancelar',
            html:
                    '<label style="float:left;">Nome do Documento: </label>' +
                    '<input value="' + obj + '" id="edit_doc_name" class="swal2-input">',
            focusConfirm: false,
            preConfirm: () => {
                doc_name = Swal.getPopup().querySelector('#edit_doc_name').value;
                if (doc_name == '') {
                    swal.showValidationError('O nome do tipo de documento é obrigatório');
                }
                return {doc_name: doc_name}
            }
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'admin.php?f=edit_doc',
                    type: "POST",
                    data: {doc_id: doc_id, doc_name: doc_name}
                }).done(function (updated) {
                    if (updated != true) {
                        Swal({
                            position: 'bottom-end',
                            type: 'error',
                            title: 'Ocorreu um erro, o tipo de documento não foi alterado',
                            toast: true,
                            showConfirmButton: false,
                            timer: 2000
                        })
                        call_page_see_documents();
                    } else {
                        Swal({
                            position: 'bottom-end',
                            type: 'success',
                            title: 'O tipo de documento foi alterado com sucesso',
                            toast: true,
                            showConfirmButton: false,
                            timer: 2000
                        })
                        call_page_see_documents();
                    }
                });
            }
        });
    });
};
//FUNÇÃO PARA ADICIONAR UM CANDIDATO A UM EVENTO
add_candidate_toevent = function (id) {
    var event_id = id;
    var options = "";
    $.ajax({
        url: 'admin.php?f=get_candidates_fjson',
        type: "POST",
        data: {event_id: event_id}
    }).done(function (result_candidates) {
        var obj_candidates = JSON.parse(result_candidates); //RECEBE O OBJETO QUE FOI RETORNADO EM FORMATO JSON
        $.ajax({
            url: 'admin.php?f=confirm_candidate_added_event',
            type: "POST",
            data: {event_id: event_id}
        }).done(function (result_candidates_added) {
            var obj_candidates_added = JSON.parse(result_candidates_added); //RECEBE O OBJETO QUE FOI RETORNADO EM FORMATO JSON
            //FAZ UM CICLO AOS CANDIDATOS
            $.each(obj_candidates, function (i) {
                not_found = true;
                //FAZ UM CICLO AOS CANDIDATOS ADICIONADOS
                $.each(obj_candidates_added, function (j) {
                    //VERIFICA SE ALGUM DOS CANDIDATOS É IGUAL A ALGUM DOS CANDIDATOS JÁ EXISTENTE NUM DETERMINADO EVENTO
                    if (obj_candidates[i].candidate_id == obj_candidates_added[j].candidate_id && event_id == obj_candidates_added[j].event_id) {
                        if (obj_candidates[i].candidate_name == '') {
                            options += '<option disabled value="' + obj_candidates[i].candidate_id + '">' + obj_candidates[i].candidate_entourage + '</option>';
                        } else {
                            options += '<option disabled value="' + obj_candidates[i].candidate_id + '">' + obj_candidates[i].candidate_name + '</option>';
                        }
                        not_found = false;
                        return;
                    }
                });
                if (not_found == true) {
                    if (obj_candidates[i].candidate_name == '') {
                        options += '<option value="' + obj_candidates[i].candidate_id + '">' + obj_candidates[i].candidate_entourage + '</option>';
                    } else {
                        options += '<option value="' + obj_candidates[i].candidate_id + '">' + obj_candidates[i].candidate_name + '</option>';
                    }
                }
            });
            Swal({
                title: 'Adicionar Candidatos ao Evento ' + event_id,
                showCancelButton: true,
                confirmButtonColor: '#1fb94b',
                cancelButtonColor: '#d33',
                confirmButtonText: '<i class="fas fa-user-plus"></i>&nbsp;&nbsp;Adicionar',
                cancelButtonText: 'Cancelar',
                html:
                        '<select name="add_candidate_event" id="add_candidate_event" class="swal2-input"> ' +
                        '<option disabled selected>Selecione um candidato</option>' + options +
                        '</select>',
                focusConfirm: false,
                preConfirm: () => {
                    candidate_id = Swal.getPopup().querySelector('#add_candidate_event').value;
                    if (candidate_id == 'Selecione um candidato') {
                        swal.showValidationError('Necessita de selecionar um candidato');
                    }
                    return {candidate_id: candidate_id}
                }
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'admin.php?f=add_candidate_event',
                        type: "POST",
                        data: {event_id: event_id, candidate_id: candidate_id}
                    }).done(function (updated) {
                        if (updated != true) {
                            Swal({
                                position: 'bottom-end',
                                type: 'error',
                                title: 'Ocorreu um erro, o candidato não foi adicionado ao evento',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000
                            })
                            call_page_see_events();
                        } else {
                            Swal({
                                position: 'bottom-end',
                                type: 'success',
                                title: 'O candidato foi adicionado ao evento com sucesso',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000
                            })
                            call_page_see_events();
                        }
                    });
                }
            });
        });
    });
};
//FUNÇÃO PARA VER OS CANDIDATOS ANTES DE UM EVENTO, SENDO POSSIVEL ELIMINÁ-LOS
see_candidates_event_delete = function (id) {
    var event_id = id;
    var html = '';
    $.ajax({
        url: 'admin.php?f=get_candidates_event_fjson',
        type: "POST",
        data: {event_id: event_id}
    }).done(function (result_candidates_event) {
        var obj_candidates_event = JSON.parse(result_candidates_event); //RECEBE O OBJETO QUE FOI RETORNADO EM FORMATO JSON
        //FAZ UM CICLO AOS CANDIDATOS
        $.each(obj_candidates_event, function (i) {
            //VERIFICA SE ALGUM DOS CANDIDATOS DO EVENTO NÃO TEM NOME
            if (obj_candidates_event[i].candidate_name == '') {
                html += '<hr>' +
                        '<ul class="no-bullets"><li>' + obj_candidates_event[i].candidate_entourage + '&nbsp;&nbsp;<button style="float:right;margin-top: -7px;" type="button" class="btn btn-delete" name="delete_event_candidate" title="Eliminar Candidato" data-candidate-id="' + obj_candidates_event[i].candidate_id + '"><i class="fas fa-trash"></i></button></li></ul>' +
                        '<hr>'
            } else {
                html += '<hr>' +
                        '<ul class="no-bullets"><li>' + obj_candidates_event[i].candidate_name + '&nbsp;&nbsp;<button style="float:right;margin-top: -7px;" type="button" class="btn btn-delete" name="delete_event_candidate" title="Eliminar Candidato" data-candidate-id="' + obj_candidates_event[i].candidate_id + '"><i class="fas fa-trash"></i></button></li></ul>' +
                        '<hr>'
            }

        });
        Swal({
            title: '<strong>Candidatos do Evento ' + event_id + '</strong>',
            html: html,
            showCloseButton: false,
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonColor: '#d33',
            cancelButtonText: '<i class="fa fa-close"></i>',
            customClass: 'candidates_scroll'
        });
        $("[name = 'delete_event_candidate']").on('click', function () {
            var candidate_id = $(this).data('candidate-id');
            $.ajax({
                url: 'admin.php?f=delete_event_candidate',
                type: "POST",
                data: {event_id: event_id, candidate_id: candidate_id}
            }).done(function (candidate_event_deleted) {
                if (candidate_event_deleted != true) {
                    Swal({
                        position: 'bottom-end',
                        type: 'error',
                        title: 'Ocorreu um erro, o candidato não foi eliminado do evento',
                        toast: true,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    call_page_see_events();
                } else {
                    Swal({
                        position: 'bottom-end',
                        type: 'success',
                        title: 'O candidato foi eliminado do evento com sucesso',
                        toast: true,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    call_page_see_events();
                }
            });
        });
    });
};

//FUNÇÃO PARA VER OS CANDIDATOS APÓS O EVENTO, SEMS SER POSSIVEL ELIMINA-LOS
see_candidates_event = function (id) {
    var event_id = id;
    var html = '';
    $.ajax({
        url: 'admin.php?f=get_candidates_event_fjson',
        type: "POST",
        data: {event_id: event_id}
    }).done(function (result_candidates_event) {
        var obj_candidates_event = JSON.parse(result_candidates_event); //RECEBE O OBJETO QUE FOI RETORNADO EM FORMATO JSON
        //FAZ UM CICLO AOS CANDIDATOS
        $.each(obj_candidates_event, function (i) {
            //VERIFICA SE ALGUM DOS CANDIDATOS DO EVENTO NÃO TEM NOME
            if (obj_candidates_event[i].candidate_name == '') {
                html += '<hr>' +
                        '<ul class="no-bullets"><li>' + obj_candidates_event[i].candidate_entourage + '</li></ul>' +
                        '<hr>'
            } else {
                html += '<hr>' +
                        '<ul class="no-bullets"><li>' + obj_candidates_event[i].candidate_name + '</li></ul>' +
                        '<hr>'
            }

        });
        Swal({
            title: '<strong>Candidatos do Evento ' + event_id + '</strong>',
            html: html,
            showCloseButton: false,
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonColor: '#d33',
            cancelButtonText: '<i class="fa fa-close"></i>',
            customClass: 'candidates_scroll'
        });
    });
};
//FUNÇÃO PARA FAZER A EXPORTAÇÃO DOS VOTOS
export_votes = function (id) {
    var event_id = id;
    $.ajax({
        url: 'admin.php?f=export_votes_event',
        type: "POST",
        data: {event_id: event_id}
    }).done(function (table) {
        if (table != '') {
            $(table).table2excel({
                exclude: ".noExl",
                name: "Votos Evento" + event_id,
                filename: "Votos Evento" + event_id + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        } else {
            alert("Ocorreu um erro, não foi possivel fazer o download dos votos do evento");
            window.location.href = url + "admin/";
        }
    });
};

//FUNÇÃO QUE VAI BUSCAR OS RESULTADOS DE UM DETERMINADO EVENTO
see_results_event_admin = function (event_id) {
    $.ajax({
        url: 'admin.php?f=see_results',
        type: "POST",
        data: {event_id: event_id}
    }).done(function (table) {
        if (table != '') {
            Swal({
                title: 'Resultados do evento ' + event_id,
                type: 'info',
                html: table,
                showConfirmButton: false,
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonColor: '#d33',
                cancelButtonText: '<i class="fa fa-close"></i>',
                customClass: 'candidates_scroll'
            });
        } else {

        }
    });
};

call_page_dashboard = function () {
    $('#mid').load(url + 'application/dashboard.php');
    $('#a-dashboard').addClass('active');
    $('#a-users').removeClass('active');
    $('#a-events').removeClass('active');
    $('#a-candidates').removeClass('active');
    $('#a-documents').removeClass('active');
};

call_page_add_user = function () {
    $('#mid').load(url + 'application/add_user.php');
    $('#a-dashboard').removeClass('active');
    $('#a-events').removeClass('active');
    $('#a-candidates').removeClass('active');
    $('#a-documents').removeClass('active');
    $('#a-users').addClass('active');
};

call_page_see_users = function () {
    $('#mid').load(url + 'application/see_users.php');
    $('#a-dashboard').removeClass('active');
    $('#a-events').removeClass('active');
    $('#a-candidates').removeClass('active');
    $('#a-documents').removeClass('active');
    $('#a-users').addClass('active');
};

call_page_see_events = function () {
    $('#mid').load(url + 'application/see_events.php');
    $('#a-dashboard').removeClass('active');
    $('#a-users').removeClass('active');
    $('#a-candidates').removeClass('active');
    $('#a-documents').removeClass('active');
    $('#a-events').addClass('active');
};

call_page_add_event = function () {
    $('#mid').load(url + 'application/add_event.php');
    $('#a-dashboard').removeClass('active');
    $('#a-users').removeClass('active');
    $('#a-candidates').removeClass('active');
    $('#a-documents').removeClass('active');
    $('#a-events').addClass('active');
};

call_page_see_candidates = function () {
    $('#mid').load(url + 'application/see_candidates.php');
    $('#a-dashboard').removeClass('active');
    $('#a-users').removeClass('active');
    $('#a-events').removeClass('active');
    $('#a-documents').removeClass('active');
    $('#a-candidates').addClass('active');
};

call_page_add_candidate = function () {
    $('#mid').load(url + 'application/add_candidate.php');
    $('#a-dashboard').removeClass('active');
    $('#a-users').removeClass('active');
    $('#a-events').removeClass('active');
    $('#a-documents').removeClass('active');
    $('#a-candidates').addClass('active');
};

call_page_see_documents = function () {
    $('#mid').load(url + 'application/see_documents.php');
    $('#a-dashboard').removeClass('active');
    $('#a-users').removeClass('active');
    $('#a-events').removeClass('active');
    $('#a-candidates').removeClass('active');
    $('#a-documents').addClass('active');
};

call_page_add_document = function () {
    $('#mid').load(url + 'application/add_document.php');
    $('#a-dashboard').removeClass('active');
    $('#a-users').removeClass('active');
    $('#a-events').removeClass('active');
    $('#a-candidates').removeClass('active');
    $('#a-documents').addClass('active');
};

$("#a-users").click(function () {
    $("#collapseUsers").collapse('toggle');
});

$("#a-events").click(function () {
    $("#collapseEvents").collapse('toggle');
});

$("#a-candidates").click(function () {
    $("#collapseCandidates").collapse('toggle');
});

$("#a-documents").click(function () {
    $("#collapseDoc").collapse('toggle');
});

/*var details = {
 "admin_email": admin_email,
 "admin_password": admin_password
 };
 console.log(details);*/