function allData(){
    console.log("all data dispaly")
    var table = document.getElementById('table');
        table.innerHTML=``
        console.log(table.innerHTML)
        contactList=JSON.parse(localStorage.getItem('itemList'))||[]
        console.log(contactList)
        
        contactList.forEach(function(value,i) {
            // var table=document.getElementById('table')
            console.log(table)
            table.innerHTML += `
            <tr> 
                <td>${i+1}</td>
                <td>${value.name}</td>
                <td>${value.address}</td>
                <td>${value.email}</td>
                <td>${value.designation}</td>
                <td>
                    <button class="btn btn-sm btn-success" onclick="find(${value.id})">
                    <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-sm btn-danger" onclick="removeData(${value.id})">
                    <i class="fa fa-trash"></i>
                    </button>
                </td>
                </tr>` 
        console.log(table.innerHTML)
            
        });
}