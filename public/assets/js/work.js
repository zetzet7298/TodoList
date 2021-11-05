// Create a "close" button and append it to each list item
var myNodelist = document.getElementsByClassName("todo-item");
var i;
for (i = 0; i < myNodelist.length; i++) {
    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00D7");
    span.className = "close";
    span.appendChild(txt);
    myNodelist[i].appendChild(span);

    var span = document.createElement("SPAN");
    span.style.marginRight = "40px";
    var txt = document.createTextNode("\u270E");
    span.className = "edit";
    span.appendChild(txt);
    myNodelist[i].appendChild(span);
}

// Click on a edit button to pass data edit the current item
var edit = document.getElementsByClassName("edit");
var i;
for (i = 0; i < edit.length; i++) {
    edit[i].onclick = function() {
        var div = this.parentElement;
        var id = div.getAttribute('id');

        var workName = $(div).find('#workName').text();
        var startingDate = $(div).find('#startingDate').attr('value');
        var startingDate = moment(new Date(startingDate * 1000)).format('YYYY-MM-DDTHH:mm');

        var endingDate = $(div).find('#endingDate').attr('value');
        var endingDate = moment(new Date(endingDate * 1000)).format('YYYY-MM-DDTHH:mm');

        console.log( $('#work-form').find("input[name='startingDate']").val());
        $('#work-form').find("input[name='workName']").val(workName);
        $('#work-form').find("input[name='startingDate']").val(startingDate);
        $('#work-form').find("input[name='endingDate']").val(endingDate);
        $('#work-form').find("#addBtn").val('Update');
        $('.err').hide();

        var uri = '/?controller=work&action=update&id=' + id;
        $('#work-form').attr('action', uri);
    }
}

// Click on a close button to hide the current list item
var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
        var ok = confirm("Are you sure delete?");

        if(ok){
            var div = this.parentElement;
            div.style.display = "none";

            var id = div.getAttribute('id');
            var uri = '/?controller=work&action=destroy&id=' + id;

            $.ajax(uri, {
                success: function(data) {
                    console.log(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }
    }
}

// Add a "checked" symbol when clicking on a list item
var list = document.querySelector('ul');
list.addEventListener('click', function(ev) {
    if (ev.target.className === 'todo-item') {
        ev.target.classList.toggle('checked');
    }
}, false);
