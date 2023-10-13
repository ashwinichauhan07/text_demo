// import { isLabelWithInternallyDisabledControl } from "@testing-library/user-event/dist/utils";

const product=[{ title:'red',id:1},
                { title:'orange',id:2},
                { title:'green',id:3}
];
const ListItem=product.map(product=>
    <li key={product.id}> {product.title}</li>);
    return(
        <ul>{ListItem}</ul>
    )
