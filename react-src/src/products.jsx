import React from "react";
import { Link } from "react-router-dom";
import LoadingIcon from "./dist/images/loading-icon.gif";
import Placeholder from "./dist/images/placeholder.jpg";

const CelestialSettings = window.CelestialSettings;
const ScrollMagic = window.ScrollMagic;
const jQuery = window.jQuery;

class Products extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            products: [],
            page: 0,
            getProducts: true,
            controller: false
        };
        this.getMoreProducts = this.getMoreProducts.bind(this);
    }

    componentWillUnmount() {
        this.getMoreProducts = null;
    }

    componentDidMount() {
        var that = this;

        // init ScrollMagic Controller
        that.state.controller = new ScrollMagic.Controller();

        // build scene
        // var scene = new ScrollMagic.Scene({ triggerElement: "#colophon", triggerHook: "onEnter" }).addTo(that.state.controller).on("enter", function(e) {
        //     if (that.state.getProducts && that.getMoreProducts !== null) {
        //         that.getMoreProducts();
        //     }
        // });
        new ScrollMagic.Scene({ triggerElement: "#colophon", triggerHook: "onEnter" }).addTo(that.state.controller).on("enter", function(e) {
            if (that.state.getProducts && that.getMoreProducts !== null) {
                that.getMoreProducts();
            }
        });
    }

    getMoreProducts() {
        var that = this;
        var totalPages;

        // adding a loader
        jQuery("#loader").addClass("active");

        this.setState({ page: this.state.page + 1 });

        fetch(
            CelestialSettings.woo.url +
                "products?page=" +
                this.state.page +
                "&consumer_key=" +
                CelestialSettings.woo.consumer_key +
                "&consumer_secret=" +
                CelestialSettings.woo.consumer_secret
        )
            .then(function(response) {
                for (var pair of response.headers.entries()) {
                    // getting the total number of pages
                    if (pair[0] === "x-wp-totalpages") {
                        totalPages = pair[1];
                    }

                    if (that.state.page >= totalPages) {
                        that.setState({ getProducts: false });
                    }
                }
                if (!response.ok) {
                    throw Error(response.statusText);
                }

                return response.json();
            })
            .then(function(results) {
                var allProducts = that.state.products.slice();
                results.forEach(function(single) {
                    allProducts.push(single);
                });
                that.setState({ products: allProducts });

                // removing the loader
                jQuery("#loader").removeClass("active");
            })
            .catch(function(error) {
                console.log("There has been a problem with your fetch operation: " + error.message);
                jQuery("#loader").remove();
            });
    }

    componentDidUpdate() {
        var fadeInController = new ScrollMagic.Controller();
        jQuery(".container .col-md-4.card-outer").each(function() {
            /*var ourScene2 =*/ new ScrollMagic.Scene({
                triggerElement: this.children[0],
                reverse: false,
                triggerHook: 1
            })
                .setClassToggle(this, "fade-in")
                .addTo(fadeInController);
        });
    }

    renderProducts() {
        return this.state.products.map((product, i) => {
            return (
                <div className="col-md-4 card-outer" key={i}>
                    <div className="card">
                        <div className="img-outer">
                            <Link to={product.slug}>
                                <img className="card-img-top" src={product.images ? product.images[0].src : Placeholder} alt="Featured" />
                            </Link>
                        </div>
                        <div className="card-body">
                            <h4 className="card-title">
                                <Link to={product.slug}>{product.name}</Link>
                            </h4>
                            <p className="card-text">
                                <small className="text-muted">$ {product.price}</small>
                            </p>
                            <p>{jQuery(product.description).text()}</p>
                        </div>
                    </div>
                </div>
            );
        });
    }

    renderEmpty() {
        return (
            <div className="card">
                <div className="card-body">
                    <h4 className="card-title">404 Page Not Found!</h4>
                    <p className="card-text">The page you requested does not exist.</p>
                    <p className="card-text">
                        <Link to={CelestialSettings.path}>Return to homepage</Link>
                    </p>
                </div>
            </div>
        );
    }

    render() {
        return (
            <div className="container post-entry">
                {this.state.products ? this.renderProducts() : this.renderEmpty()}
                <img src={LoadingIcon} alt="loader gif" id="loader" />
            </div>
        );
    }
}

export default Products;
