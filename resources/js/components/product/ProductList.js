import React,{useState,useEffect} from 'react';
import axios from 'axios';
import {Link} from 'react-router-dom'

const ProductsList = () =>{
    const [products,setProduct]=useState([]);

    useEffect(() => {
        loadProducts();
    }, []);


    const loadProducts = async () => {
        const result = await axios.get("http://127.0.0.1:8000/api/products");
        setProduct(result.data.data);
        // const products=result.data.data;
        console.log(products);
    };
    const deleteProduct = async id => {
        await axios.delete(`http://127.0.0.1:8000/api/products/${id}`);
        loadProducts();
    };
    return (

        <div className="container">
            <div className="py-4">
                <h1>Home Page</h1>
                <table className="table border shadow">
                    <thead className="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {products.map((product, index) => (
                        <tr>
                            <th scope="row">{index + 1}</th>
                            <td>{product.name}</td>
                            <td>{product.description}</td>
                            <td>{product.price}</td>
                            <td>
                                <Link class="btn btn-primary mr-2" to={`/products/${product.id}`}>
                                    View
                                </Link>
                                <Link
                                    class="btn btn-outline-primary mr-2"
                                    to={`/products/edit/${product.id}`}
                                >
                                    Edit
                                </Link>
                                <Link
                                    class="btn btn-danger"
                                    onClick={() => deleteProduct(product.id)}
                                >
                                    Delete
                                </Link>
                            </td>
                        </tr>
                    ))}
                    </tbody>
                </table>
            </div>
        </div>
    );
}

export default ProductsList;
