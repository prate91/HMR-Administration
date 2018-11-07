//generate casual password
function casualPassword() {
    var elencoCaratteri = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

    var minimoCaratteri = 6;
    var massimoCaratteri = 10;
    var differenzaCaratteri = massimoCaratteri - minimoCaratteri;

    var lunghezza = Math.round((Math.random() * differenzaCaratteri) + minimoCaratteri);

    var incremento = 0;
    var password = "";

    while (incremento < lunghezza) {
        password += elencoCaratteri.charAt(Math.round(Math.random() * elencoCaratteri.length));
        incremento++;
    }
    return password;
}




$(document).ready(function () {
    //Pagina Gestione Utenti
    var listaUser;
    var url = "../Api/estraiListaUtenti.php"
    intestazione_tabella_utenti = "";

    //chiamata AJAX
    $.getJSON(url, function (result) {
        $.each(result, function (index, item) {
            var riga = "<tr><td>" + item.Username + "</td>" +
                "<td>" + item.AdministratorPermission + "</td>" +
                "<td>" + item.WebEditorPermission + "</td>" +
                "<td>" + item.EditorPermission + "</td>" +
                "<td>" + item.ReviserPermission + "</td>" +
                "<td>" + item.IdPp_Id + "</td>";
            intestazione_tabella_utenti += riga;
            $("#corpoListaUtenti").html(intestazione_tabella_utenti);
            listaUser += "<option value='" + item.Username + "'>" + item.Username + "</option>";
        });
        $('#listaUtenti').DataTable();
        $("#optionUtenti").html(listaUser);
    });

    var peopleList;
    var url = "../Api/extractPeople.php"

    //chiamata AJAX
    $.getJSON(url, function (result) {
        $.each(result, function (index, item) {
            peopleList += "<option value='" + item.IdPp + "'>" + item.Name + " " + item.Surname + "</option>";
        });
        $("#optionPeople").html(peopleList);
    });


    $("table").on("click", ".btnUtente", function () {
        var id_auth = $(this).attr("id");
        $(".hidden_id_auth").val(id_auth);
    });


    $("#generaPasswordUtente").click(function () {
        var password = casualPassword();
        $("#password").val(password);
    });

    $("#generaPassword").click(function () {
        var password = casualPassword();
        $("#pw").val(password);
    });

    $("#btnPassword").click(function () {
        $("#gestionePassword").show();
    });

    $("#cambiaPassword").click(function () {
        var pw = $('[name="pw"]').val();
        $("#passwordOutput").html(pw);
    });






    $("#modalEliminaUtente").on('click', '#eliminaDef', function () {
        var id_auth = $('.hidden_id_auth').val();
        window.location = "../Api/eliminaUtente.php?id_auth=" + id_auth + "";

    });

    $("#btnCreaUtente").click(function () {
        $("#creaUtente").show();
    });
    $("#chiudi").click(function () {
        $("#creaUtente").hide();
    });
    $("#chiudiPassword").click(function () {
        $("#gestionePassword").hide();
    });


    $("#alertEvento").alert();
    $("#alertEvento").fadeTo(2000, 500).slideUp(500, function () {
        $("#alertEvento").slideUp(500);
    });

});
