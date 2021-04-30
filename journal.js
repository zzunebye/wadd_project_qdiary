$(document).ready(function () {
    $.ajax({
        url: "http://<?php echo $hostname;?>/wadd_project_qdiary/model/getcards.php",
        type: "GET",
        dataType: "json",
        ContentType: "application/json",
        success: function (response) {
            response = JSON.stringify(response);
        },
        error: function (err) {}
    }).done(function (data) {

        let card = ''

        const cards = data.map((element, i) => {
            const created = element['created_time'];
            const card_title = element['card_title'];
            const card_content = element['card_content'];
            const picture = element['card_pic'];

            const start = new Date("<?php echo $start; ?>");

            const created_day = new Date(created.slice(0, 10));
            const check = (picture == null) ? "none" : "inline-block";
            const day = ((created_day - start) / 1000 / 60 / 60 / 24);
            const newCard =
                `
                        <div class="cardContainer" id="#list-item-${day+1}">
                            <div class="day">Day ${day+1}
                            <span class="created">${created.slice(0,10)}</span>
                            </div>
                            
                            <div class="card mb-4 shadow ">
                                <div class="card-header ">
                                    ${created.slice(-9)}
                                </div>
                                <div class="card-body">
                                    <div style="width: 100%; height: 100%;">
                                    <h5 class="card-title">${card_title}</h5>
                                    <p class="card-text">${card_content}</p>
                                    </div>
                                
                                </div>
                            </div>
                            <div class="picture" id="picture" 
                                    style="background-image: url('images/${picture}'); display: ${check}">
                                    
                                </div>
                        </div>
                       `
            card = card + newCard
            const new_list_nav = `<a class="list-group-item list-group-item-action" href="#list-item-${day+1}">${day+1}</a>`

        });
        document.querySelectorAll('#list-item-')
        document.getElementById("uk-timeline").innerHTML = card;

    });
})