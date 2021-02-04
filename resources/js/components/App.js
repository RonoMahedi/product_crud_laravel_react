import React, { Component } from "react";
import ReactDOM from "react-dom";

import { BrowserRouter as Router, Switch, Route} from "react-router-dom";
import Header from "./layouts/Header";
import Footer from "./layouts/Footer";
import { Container } from "react-bootstrap";
import ProductList from "./product/ProductList";
import AddProduct from "./product/AddProduct";
import ProductShow from "./product/ProductShow";
import EditProduct from "./product/EditProduct";


class App extends Component {
    state = {
        PUBLIC_URL: "/myTask/",
    };

    render() {
        return (
            <div>
                <Router>
                    <Header/>
                    <div>
                        <Container>
                            <Switch>
                                <Route exact path="/" component={ProductList}/>
                                <Route exact path="/products/add" component={AddProduct}/>
                                <Route exact path="/products/:id" component={ProductShow} />
                                <Route exact path="/products/edit/:id" component={EditProduct} />
                            </Switch>
                        </Container>
                    </div>
                    <Footer/>
                </Router>
            </div>
        );
    }
}

export default App;

if (document.getElementById("app")) {
    ReactDOM.render(<App />, document.getElementById("app"));
}
