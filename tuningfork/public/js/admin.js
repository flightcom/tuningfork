var activePage;
var activeMenu = 0;

$(document).ready(function(){

    // Pour la selection de la page
    if(document.referrer.indexOf('admin') == -1) {
        localStorage.removeItem('activePage');        
    }

    if ( localStorage.activePage != undefined ) {
        activePage = $.parseJSON(localStorage.getItem('activePage'));
    } else {
        activePage = 0;
    }

    $('.nav-sidebar li').eq(activePage).addClass('active');

    $('.nav-sidebar li').click(function(){
        var index = $(this).index();
        localStorage.removeItem('activePage');
        localStorage.setItem('activePage', index);
        $('.nav-sidebar').removeClass('active');
    });

    // Pour la selection du menu
    if(document.referrer.indexOf('admin') == -1) {
        localStorage.removeItem('activeMenu');        
    }


    if ( localStorage.activeMenu != undefined ) {
        var tmpMenu1 = localStorage.getItem('activeMenu');
        console.log(tmpMenu1);
        var tmpMenu2 = tmpMenu1.split('-');
        activePageMenu = tmpMenu2[0];
        if ( activePageMenu != activePage )  { 
            localStorage.removeItem('activeMenu');
        } else {
            activeMenu = tmpMenu2[1];
        }
    }

    $('.nav-menu li').eq(activeMenu).addClass('active');

    $('.nav-menu li').click(function(){
        var index = $(this).index();
        localStorage.removeItem('activeMenu');
        localStorage.setItem('activeMenu', activePage + '-' + index);
        $('.nav-menu').removeClass('active');
    });

    // Instantiate the Bloodhound suggestion engine
    var membres = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum.value);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/admin/ajax/searchMember/%QUERY',
            filter: function (membres) {
                return $.map(membres, function (membre) {
                    return {
                        value: membre.membre_prenom + ' ' + membre.membre_nom,
                        id: membre.membre_id
                    };
                });
            }
        }
    });

    var instruments = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum.value);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/admin/ajax/searchInstru/%QUERY',
            filter: function (instruments) {
                return $.map(instruments, function (instru) {
                    return {
                        value: instru.marque_nom + ' ' + instru.instru_modele,
                        id: instru.instru_id
                    };
                });
            }
        }
    });

    // Initialize the Bloodhound suggestion engine
    membres.initialize();
    instruments.initialize();

    // Instantiate the Typeahead UI
    $('#search').typeahead(
    {
        highlight: true,
        minLength: 3,
        template: {
            empty: '<div class="empty-message">Aucun résultat</div>'
        }
    },
    {
        name: 'membres',
        displayKey: 'value',
        source: membres.ttAdapter(),
        templates: {
            header: '<h4 class="search-result-title">Membres</h4>',
            suggestion: Handlebars.compile("<p><a href='/admin/membres/{{id}}'>{{value}}</a></p>")
        }
    },
    {
        name: 'instruments',
        displayKey: 'value',
        source: instruments.ttAdapter(),
        templates: {
            header: '<h4 class="search-result-title">Instruments</h4>',
            suggestion: Handlebars.compile("<p><a href='/admin/instruments/{{id}}'>{{value}}</a></p>")
        }
    }
    );

    // Soumission formulaire de recherche
    $('.navbar-fixed-top form input').on("keypress", function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {
            e.preventDefault();
            e.stopPropagation();
            $(this).closest('form').submit();
        }
    });

});

function loadAddInstruView(){

    $('#add button').hide();
    $.ajax({
        type: 'GET', 
        url: '/admin/ajouter_instrument',
        success: function(data){
            $('#add').append(data);
        }
    });

}

function cancelNewInstrument(){

    $('#add > *:not(button)').remove();
    $('#add button').show();
}

function loadAddMemberView(){

    $('#add').load('/admin/membres/ajouter_membre');

}

function editForm(id){

    $('#'+id+' .editable').removeAttr('readonly');
    $('button.editable').attr('data-toggle', 'dropdown').find('span:last-child').addClass('caret');
    $('.no-edition').addClass('hidden');
    $('.edition').removeClass('hidden');
}

function uneditForm(id){

    $('#'+id+' .editable').attr('readonly', '');
    $('button.editable').attr('data-toggle', '').find('span:last-child').removeClass('caret');
    $('.no-edition').removeClass('hidden');
    $('.edition').addClass('hidden');
}

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("dragndrop", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("dragndrop");
    var droppedElement = $('#'+data);
    droppedElement.remove();
    $(ev.target).append(droppedElement);
}

function dropcateg(ev) {
    drop(ev);
    var categid = ev.dataTransfer.getData("dragndrop").split('_')[1];
    var index = $('.list-categories').index($(ev.target));
    var parentid = index == 0 ? null : '';
    console.log('categid = '+categid+', parentid = '+);
    // $.ajax({
    //     type: 'post', 
    //     url: '/admin/editCategorie',
    //     data: 'categid='+ev.dataTransfer.getData("dragndrop").split('_')[1]+'&categparentid=';
    //     success: function(data){
    //         $('#add').append(data);
    //     }
    // });
}