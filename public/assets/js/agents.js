(function ($) {
    "use strict"
    //New item
    $('#btn-left-add-new-row, #btn-right-add-new-row').click(function () {
        showWait()
        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };
        fetch('http://localhost:8080/api/communes', requestOptions)
            .then(response => response.json())
            .then(json => {
                var communes = JSON.parse(json.communes)
                if (communes.length > 0) {
                    for (var i = 0; i < communes.length; i++){
                        $('#select-commune').append(
                            $('<option>')
                                .attr('value', communes[i].id)
                                .html(communes[i].name)
                        )
                    }
                }
            })
            .catch(error => {
                console.log('error', error)
            })
        var panelDetails = $('.panel-right')
        panelDetails.find('.grid-row-count').html('#')
        panelDetails.find('.name-span').html('New item')
        panelDetails.find('.separator').html(' - ')

        panelDetails.find('#index-tr').html('#')
        panelDetails.find('#input-id').val('')
        panelDetails.find('#input-name').val('')
        panelDetails.find('#select-agent').val('')
        panelDetails.find('#input-matricule').val('')
        panelDetails.find('#input-username').val('')
        panelDetails.find('#input-password').val('')
        panelDetails.find('.pwrd').fadeIn()
        panelDetails.find('#input-status').prop('checked', false)
        /* label message */
        setTimeout($('#label-message').fadeOut(), 3000)
        //Show form
        setTimeout($('#main-form').fadeIn(),4000)
        /*remove wait*/
        setTimeout(hideWait, 3000)
    })

    //Row details
    $("body").on("click", "table#data-list tbody#load-data tr", function () {
        showWait()
        var requestOption = {
            method: 'GET',
            redirect: 'follow'
        };
        fetch('http://localhost:8080/api/communes', requestOption)
            .then(response => response.json())
            .then(json => {
                var communes = JSON.parse(json.communes)
                if (communes.length > 0) {
                    for (var i = 0; i < communes.length; i++){
                        $('#select-commune').append(
                            $('<option>')
                                .attr('value', communes[i].id)
                                .html(communes[i].name)
                        )
                    }
                }
            })
            .catch(error => {
                console.log('error', error)
            })
        $("table#data-list tbody tr").removeClass("selected");
        $(this).toggleClass("selected")

        //Get agent detail
        var id = $(this).attr('data-agent-id')
        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };

        fetch("http://localhost:8080/api/agent/"+id, requestOptions)
            .then(response => response.text())
            .then(result => {
                var agent = JSON.parse(result)
                console.log(agent)
                var panelDetails = $('.panel-right')
                /*hydrate panel right with data*/
                panelDetails.find('.grid-row-count').html($(this).find('td:eq(0)').text())
                panelDetails.find('#index-tr').html($(this).find('td:eq(0)').text())
                panelDetails.find('.separator').html(' - ')

                panelDetails.find('.name-span').html(agent.full_name)
                panelDetails.find('#input-id').val(agent.id)
                panelDetails.find('#input-name').val(agent.full_name)
                panelDetails.find('#select-commune').val(agent.commune_id)
                panelDetails.find('#input-matricule').val(agent.matricule_number)
                panelDetails.find('#input-username').val(agent.username)
                panelDetails.find('.pwrd').fadeOut()
                panelDetails.find('#input-status').val(agent.status)
                /* label message */
                setTimeout($('#label-message').fadeOut(), 3000)

                /* Show form details */
                setTimeout($('#main-form').fadeIn(),4000)

                /*remove wait*/
                setTimeout(hideWait, 3000)

            })
            .catch(error => {
                console.log('error', error)
                /*remove wait*/
                setTimeout(hideWait, 3000)
            });
    })

    //Save
    $('#btnActionSave').click(function () {

        if ($('#input-id').val()){
            showWait()
            var id = $('#input-id').val()

            var myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

            var urlencoded = new URLSearchParams();
            urlencoded.append("full_name", $('#input-name').val());
            urlencoded.append("commune_id", $('#select-commune').val());
            urlencoded.append("matricule_number", $('#input-matricule').val());
            urlencoded.append("username", $('#input-username').val());
            urlencoded.append("password", 'sdfghjsdfgh');
            urlencoded.append("status", $('#input-status').val());

            var requestOptions = {
                method: 'PUT',
                headers: myHeaders,
                body: urlencoded,
                redirect: 'follow'
            };
            fetch("http://localhost:8080/api/agent/"+id, requestOptions)
                .then(response => response.text())
                .then(result => {
                    console.log(result)
                    hideWait()
                })
                .catch(error => {
                    console.log('error', error)
                    hideWait()
                });

        }else {
            showWait()
            var formdata = new FormData();
            formdata.append("full_name", $('#input-name').val());
            formdata.append("commune_id", $('#select-commune').val());
            formdata.append("matricule_number", $('#input-matricule').val());
            formdata.append("username", $('#input-username').val());
            formdata.append("password", $('#input-password').val());
            formdata.append("status", $('#input-status:checked').val());

            var requestOptions = {
                method: 'POST',
                body: formdata,
                redirect: 'follow'
            };
            fetch("http://localhost:8080/api/agent", requestOptions)
                .then(response => response.text())
                .then(result => {
                    hideWait()
                    console.log(result)
                })
                .catch(error => {
                    console.log('error', error)
                    hideWait()
                });
        }
    })
})(jQuery)

//Load data tables
function loadData($){
    fetch('http://localhost:8080/api/agents')
        .then(response => response.json())
        .then(json => {
            //console.log(JSON.parse(json.agents))
            var agents = JSON.parse(json.agents)
            if (agents.length > 0){
                //Hide empty error
                $('.label-message-empty-table').fadeOut()

                $('.pl-grid-row-count').html(agents.length)
                $('.pl-name-span').html(agents.length>1 ? 'Agents': 'Agent')
                for (var i = 0; i < agents.length; i++){
                    $('table#data-list').find(' tbody#load-data').append(
                        $('<tr>')
                            .attr('data-agent-id', agents[i].id)
                            .append(
                                $('<td>')
                                    .html('#'+ (i+1))
                            )
                            .append(
                                $('<td>')
                                    .html(agents[i].full_name)
                            )
                            .append(
                                $('<td>')
                                    .html(agents[i].matricule_number)
                            )
                            .append(
                                $('<td>')
                                    .html(agents[i].username)
                            )
                            .append(
                                $('<td>')
                                    .html(agents[i].status)
                            )

                    )
                }
            }else {
                $('.pl-grid-row-count').html('Aucun')
                $('.pl-name-span').html('agent trouver.')
            }


        })
};
