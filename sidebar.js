

function display() {
    document.getElementById('add_div').style.display = 'block';
    document.getElementById('edit_div').style.display = 'none';
    document.getElementById('update_div').style.display = 'none';
    document.getElementById('view_div').style.display = 'none';
    document.getElementById('fulfill_div').style.display = 'none';
    
    if(document.body.contains(document.getElementById('addError'))){
        document.getElementById('addError').style.display = 'block';
    }
}
function edit() {
    document.getElementById('add_div').style.display = 'none';
    document.getElementById('edit_div').style.display = 'block';
    document.getElementById('update_div').style.display = 'none';
    document.getElementById('view_div').style.display = 'none';
    document.getElementById('fulfill_div').style.display = 'none';
    
    if(document.body.contains(document.getElementById('addError'))){
        document.getElementById('addError').style.display = 'none';
    }
}

function update() {
    document.getElementById('add_div').style.display = 'none';
    document.getElementById('edit_div').style.display = 'none';
    document.getElementById('update_div').style.display = 'block';
    document.getElementById('view_div').style.display = 'none';
    document.getElementById('fulfill_div').style.display = 'none';
    
    if(document.body.contains(document.getElementById('addError'))){
        document.getElementById('addError').style.display = 'none';
    }
}

function view() {
    document.getElementById('add_div').style.display = 'none';
    document.getElementById('edit_div').style.display = 'none';
    document.getElementById('update_div').style.display = 'none';
    document.getElementById('view_div').style.display = 'block';
    document.getElementById('fulfill_div').style.display = 'none';
    
    if(document.body.contains(document.getElementById('addError'))){
        document.getElementById('addError').style.display = 'none';
    }
}
function fulfill() {
    document.getElementById('add_div').style.display = 'none';
    document.getElementById('edit_div').style.display = 'none';
    document.getElementById('update_div').style.display = 'none';
    document.getElementById('view_div').style.display = 'none';
    document.getElementById('fulfill_div').style.display = 'block';
    
    if(document.body.contains(document.getElementById('addError'))){
        document.getElementById('addError').style.display = 'none';
    }
}
