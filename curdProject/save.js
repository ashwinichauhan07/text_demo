function save(){
    // console.log("working");
    contactList=JSON.parse(localStorage.getItem('listItem')) || []
    var id=1
    // console.log(id);
    if (contactList.length > 0) {
        id = Math.max(...contactList.map(item => item.id)) + 1;
        // console.log(id);
    }
            
            const name=document.getElementById('name').value;
            const address=document.getElementById('address').value;
            const email=document.getElementById('email').value;
            const designation=document.getElementById('designation').value;
            // const gender=document.querySelector('.form-control:checked').value;
        
            const newItem={
                id:id,
                name: name,
                address:address,
                email:email,
                designation:designation,
                // gender:gender
            };
            // console.log(name);
            const inputId = document.getElementById('id').value;
            if (inputId) {
                const indexToUpdate = contactList.findIndex(item => item.id === parseInt(inputId));
                if (indexToUpdate !== -1) {
                    contactList[indexToUpdate] = newItem;
                }
            }
            else{
                // console.log(newItem);
                contactList.push(newItem);
                // console.log(contactList);
             }
    localStorage.setItem('listItem',JSON.stringify(contactList));
    // console.log(contactList);
    allData();
   
    // document.getElementById('form').reset()
}

