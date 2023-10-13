function find(id){
    console.log("it is working")
    contactList =   JSON.parse(localStorage.getItem('listItem'))??[]
    contactList.forEach(function(value) {
        if(value.id==id){
        document.getElementById('id').value=value.id
        document.getElementById('name').value=value.name
        document.getElementById('address').value=value.address
        document.getElementById('email').value=value.email
        document.getElementsByClassName('btn').value=value.gender        
        }
    });
}