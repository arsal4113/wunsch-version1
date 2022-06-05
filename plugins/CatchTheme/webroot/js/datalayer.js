var google = {
        'buyerId': undefined, // '112233', // oracle ID of the buyer. only for purchase events
        'ecommerce': {},
        'event': 'page',
        'loginType': 'account', // default login type is "account", alternatives are facebook, twitter, google, instagram and ebay ATM not active
        'registrationMethod': 'Form Fill', // default
        'registrationStep': undefined,
        'resultsNo': undefined,
        'userGender': undefined,
        'userId': undefined // logged user id, ATM not better defined..
    },
    pandata = {
        'basketProducts': [],
        'category': undefined,
        'pageType': undefined,
        'paymentOption': undefined,
        'purchaseOrderId': undefined,
        'query': undefined,
        'resultsNo': undefined,
        'revenue': undefined,
        'shipping': undefined,
        'tax': undefined,
        'coupon': undefined
    },
    productImpressionPosition = 1,
    productImpressions = {};

function push2dataLayer (obj) {
    var dataLayer = window.dataLayer || [];
    dataLayer.push(obj);
    if (document.domain != 'catch.app') {
        console.log(obj, 'was pushed to GTM container!');
    }
}

function processProductData (json_data, storage, basket) {

    if (json_data.length)
    {
        var output = [];//console.log('json_data is an array..');

        for (var i = 0; i < json_data.length; i++)
        {
            var data = {};

            if (storage) {//console.log('checking storage for item pandata_products_' + json_data[i].id);
                var item = JSON.parse(window.localStorage.getItem('pandata_products_' + json_data[i].itemVrtnId)); // after WD-759 proposal
                if (item) {//console.log('item pandata_products_' + json_data[i].id + ' was found');
                    data = item;
                    data.quantity = json_data[i].quantity; // only available in checkout session array
                } else {//console.log('item pandata_products_' + json_data[i].id + ' was NOT found');
                    data = processProductData(json_data[i], storage, basket);
                }
            }
            else {
                data = processProductData(json_data[i], storage, basket);
            }

            data.position = productImpressionPosition++;

            output.push(data);
        }

    } else {//console.log('json_data is an object..');
    	
    	if (pandata.pageType == 'home' && json_data.list == 'Category') {
    		json_data.list = 'Homepage Product Grid';
    	}

        //Object.keys(json_data).forEach(key => json_data[key] === undefined && delete json_data[key]); // strips out undefined remaining values, not mandative.. ATM not compatible with IE!

        if (!storage) {//console.log('checking storage for item pandata_products_' + json_data.id);
//alert(json_data.id);
            var pandata_products_keys = new Array; // let's do some cleanup

            for (var property in window.localStorage) {
                if (property.indexOf('pandata_products_') !== -1) {
                    pandata_products_keys.push(property);
                }
            }
            for (var i = 0; i <= pandata_products_keys.length - 99; i++) { // deleting all but last 99 keys/values
                window.localStorage.removeItem(pandata_products_keys[i]);
            }

            try {
                if (list = window.localStorage.getItem('pandata_productslist_' + json_data.id)) {
                    json_data.list = list;
                }
                window.localStorage.setItem('pandata_products_' + json_data.itemVrtnId, JSON.stringify(json_data));
            } catch (e) {
                console.log(e.message); // cleanup didn't help
            }
        }

        if (!json_data.position) {
            json_data.position = productImpressionPosition++;
        }

        return json_data;
    }

    if (basket) {//console.log("to the basket", output);
        pandata.basketProducts = output;
    }

    return output;
}

function pushEcommerce (event, products, user) {
    var output = $.extend(true, {}, google);
    output.event = event;
    if (products != null) {
    	output.resultsNo = products.hasOwnProperty('id') ? 1 : products.length, // for productImpression
    	output.ecommerce.currency_code = products[0] && products[0].length ? products[0].currency_code : 'EUR'; // fallback
    }
    if (event == 'productImpression' || event == 'quizImpression') {
    	if (bannerType = window.localStorage.getItem('pandata_heroitem_banner_type')) {
    		output.bannerType = bannerType;
    		window.localStorage.removeItem('pandata_heroitem_banner_type');
    	} else output.bannerType = false;
    	if (bannerTarget = window.localStorage.getItem('pandata_heroitem_banner_target')) {
    		output.bannerTarget = bannerTarget;
    		window.localStorage.removeItem('pandata_heroitem_banner_target');
    	} else output.bannerTarget = false;
        if (products.hasOwnProperty('quantity')) {
            products.quantity = null;
        } else { // for multiple impressions..
            for (var i = 0; i < products.length; i++) {
                products[i].quantity = null;
            }
        }
        output.ecommerce.impressions = products;
        if (!output.resultsNo) { // fallback in certain cases
            output.resultsNo = Object.keys(products).length;
        }
    } else if (event == 'newSetOfProductsLoaded') { // experimental
    	output.productsInSet = products; // special use here..
    	delete output.resultsNo; // mmm..
    } else if (event == 'productClick' || event == 'quizClick') {
    	if (bannerType = window.localStorage.getItem('pandata_heroitem_banner_type')) {
    		output.bannerType = bannerType;
    		window.localStorage.removeItem('pandata_heroitem_banner_type');
    	} else output.bannerType = false;
    	if (bannerTarget = window.localStorage.getItem('pandata_heroitem_banner_target')) {
    		output.bannerTarget = bannerTarget;
    		window.localStorage.removeItem('pandata_heroitem_banner_target');
    	} else output.bannerTarget = false;
        output.ecommerce.click = {
            'actionField': {
                'list': pandata.pageType
            }
        };
        try {
            window.localStorage.setItem('pandata_productslist_' + products[0].id, products[0].list);
        } catch (e) {
            console.log(e.message);
        }
        products[0].quantity = null;
        output.ecommerce.click.products = products;
    } else if (event == 'productDetail') {
        if (list = window.localStorage.getItem('pandata_productslist_' + products[0].id)) {
            products[0].list = list;
        }
        products[0].quantity = null;
        output.ecommerce.detail = {
            'products': products
        };
    } else if (event == 'addToWishlist' || event == 'addToWishlistFromMiniCart') {
    	output.productAdded = window.localStorage.getItem('pandata_wishlist_added_product_name');
    	output.productSKU = window.localStorage.getItem('pandata_wishlist_added_product_sku');
    	output.productCategory = window.localStorage.getItem('pandata_wishlist_added_product_category');
    	if ((output.productCategory == 'MiniCart' || output.productCategory == 'WishList') && (item = JSON.parse(window.localStorage.getItem('pandata_products_' + output.productSKU)))) {
    		output.productCategory = item.category;
    	}
    } else if (event == 'removeFromWishlist' || event == 'removeFromWishlistFromMiniCart') {
    	output.productRemoved = window.localStorage.getItem('pandata_wishlist_added_product_name');
    	output.productSKU = window.localStorage.getItem('pandata_wishlist_added_product_sku');
    	output.productCategory = window.localStorage.getItem('pandata_wishlist_added_product_category');
    	if ((output.productCategory == 'MiniCart' || output.productCategory == 'WishList') && (item = JSON.parse(window.localStorage.getItem('pandata_products_' + output.productSKU)))) {
    		output.productCategory = item.category;
    	}
    } else if (event == 'addToCart' || event == 'readdToCart' || event == 'readdToMiniCart') {
        if (list = window.localStorage.getItem('pandata_productslist_' + products[0].id)) {
            products[0].list = list;
        }
        output.ecommerce.add = {
            'products': products
        };
    } else if (event == 'removeFromCart' || event == 'removeFromMiniCart') {
        output.ecommerce.remove = {
            'products': products
        };
    } else if (event == 'checkout1') {
        output.ecommerce.checkout = {
            'actionField': {
                'step': 1
            },
            'products': products
        };
    } else if (event == 'checkout2') {
        output.ecommerce.checkout = {
            'actionField': {
                'step': 2
            },
            'option': pandata.paymentOption,
            'products': products
        };
    } else if (event == 'purchase') {
        output.buyerId = undefined, // TBD, see above.. login + account-orders needed
        output.ecommerce.purchase = {
            'actionField': {
                'id': pandata.purchaseOrderId ? pandata.purchaseOrderId : undefined, // 'T11111', // Transaction ID
                'revenue': pandata.revenue, // '39.80', // total price of the order
                'shipping': pandata.shipping, // '5.90' // total shipping cost
                'tax': pandata.tax, // '8.25', // Stored as a percentage value. So an 8.25% sales tax would have a value of 8.25 in the TAX field.
                'coupon': pandata.coupon
            },
            'products': products
        };
    } else if (event == 'login') {
    	if (window.localStorage.getItem('pandata_login_type')) {
    		output.loginType = window.localStorage.getItem('pandata_login_type');
    	}
    	output.userId = window.localStorage.getItem('pandata_login_userid');
    	if (output.loginType != 'account') {
    		output.referrer = window.location.origin;
    	}
    } else if (event == 'registrationFlow1') { // start of registration tracking events
    	output.registrationStep = 'Registriere Dich Jetzt';
    } else if (event == 'registrationFlow2') {
    	output.registrationStep = 'Captcha Complete';
    } else if (event == 'registrationFlow2/3') {
    	output.registrationStep = 'Social Signup Click';
    	var registrationMethod = window.localStorage.getItem('pandata_login_type');
    	if (registrationMethod != 'account') {
    		output.registrationMethod = registrationMethod;
    	}
    } else if (event == 'registrationFlow3') {
    	output.registrationStep = 'Registration Form Complete';
    } else if (event == 'registrationFlow4') {
    	output.registrationStep = 'Registration Complete';
    	var registrationMethod = window.localStorage.getItem('pandata_login_type');
    	if (registrationMethod != 'account') {
    		output.registrationMethod = registrationMethod;
    	}
    }
    push2dataLayer(output);
}

function visibleInViewport (el) {
    var area = el.getBoundingClientRect()
        pixel_tolerance = 11;
    return ((area.top >= - pixel_tolerance)
        && (area.left >= - pixel_tolerance)
        && (area.bottom <= (window.innerHeight || document.documentElement.clientHeight) + pixel_tolerance)
        && (area.right <= (window.innerWidth || document.documentElement.clientWidth) + pixel_tolerance));
}

window.isResizing = false;
function notResizing () {
    window.isResizing = false;
    checkProductImpressions();
}
$(window).on('resize', function (e) {
    clearTimeout(window.isResizing);
    window.isResizing = setTimeout(notResizing, 666);
});

function slickSlideCheck (element) {
	var slickSlideParent = element.closest('.slick-slide');
	if (slickSlideParent.length) {
		return (slickSlideParent.hasClass('slick-active'));
	}
	return true;
}

function checkProductImpressions () {
    if (window.isResizing) return; // hehe 8-D, see above..
    //setTimeout(function () {
	    for (var product_impression in productImpressions) {
	    	var element = $(productImpressions[product_impression].el);
	        if (productImpressions[product_impression]
	         && element.is(':visible')
	         && visibleInViewport(productImpressions[product_impression].el)
	         && slickSlideCheck(element.parent().parent())) {
	            productImpressions[product_impression].cb();
	            productImpressions[product_impression] = false;
	        }
	    }
    //}, 666);
};
window.addEventListener('load', function (e) {
    checkProductImpressions();
});
window.addEventListener('scroll', function (e) {
    checkProductImpressions();
});
        