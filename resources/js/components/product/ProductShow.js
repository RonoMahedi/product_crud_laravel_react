import React, { useState, useEffect } from "react";
import { Link, useParams } from "react-router-dom";
import axios from "axios";

const ProductShow = () => {
    const [product, setProduct] = useState({
        name: "",
        description: "",
        price: ""
    });
    const { id } = useParams();
    useEffect(() => {
        loadProduct();
    }, []);
    const loadProduct = async () => {
        const result = await axios.get(`http://127.0.0.1:8000/api/products/${id}`);
        setProduct(result.data);

    };
    return (
        <div className="container py-4">
            <Link className="btn btn-primary" to="/">
                back to Home
            </Link>
            <h1 className="display-4">Product Id: {id}</h1>
            <hr />
            <ul className="list-group w-50">
                <li className="list-group-item">name:{product.name}</li>
                <li className="list-group-item">Description {product.description}</li>
                <li className="list-group-item">Price: {product.price}</li>
            </ul>
        </div>
    );
};

export default ProductShow;
