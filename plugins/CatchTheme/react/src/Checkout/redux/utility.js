const emptyAddress = {
    email: '',
    first_name: '',
    last_name: '',
    address_line_1: '',
    postal_code: '',
    city: '',
    company: '',
    address_line_2: '',
    phone_number: '',
    state_or_province: '',
    country: 'DE',
    save_address: false
};

export const controls = {
    email: {
        name: 'email',
        validationRules: {
            email: true
        },
        type: 'f'
    },
    first_name: {
        name: 'first_name',
        className: 'half',
        validationRules: {
            notEmpty: true
        },
        type: 'm_p'
    },
    last_name: {
        name: 'last_name',
        className: 'half',
        validationRules: {
            notEmpty: true
        },
        type: 'm_p'
    },
    address_line_1: {
        name: 'address_line_1',
        validationRules: {
            notEmpty: true
        },
        type: 'f'
    },
    postal_code: {
        name: 'postal_code',
        validationRules: {
            notEmpty: true
        },
        type: 'f'
    },
    city: {
        name: 'city',
        validationRules: {
            notEmpty: true
        },
        type: 'm_s'
    },
    company: {
        name: 'company',
        validationRules: {},
        type: 'f'
    },
    address_line_2: {
        name: 'address_line_2',
        validationRules: {},
        type: 'm'
    },
    phone_number: {
        name: 'phone_number',
        validationRules: {},
        type: 'f'
    },
    state_or_province: {
        name: 'state_or_province',
        validationRules: {
            notEmpty: true
        },
        type: 'n'
    },
    country: {
        name: 'country',
        disabled: true,
        type: 'select',
        options: {
            DE: 'Germany'
        },
        validationRules: {}
    }
};

const emptyLogin = {
    email: '',
    password: '',
    user_login: false
};

export const loginControls = {
    email: {
        name: 'email',
        validationRules: {
            email: true
        },
        type: 'f'
    },
    password: {
        name: 'password',
        validationRules: {
            notEmpty: true
        }
    }
};

export const buildInitialStateFromAddress = (shippingAddress, additionalData) => {
    let address = emptyAddress;
    if (shippingAddress) {
        address = shippingAddress;
    }
    address.email = additionalData.email || '';
    address.first_name = additionalData.first_name || '';
    address.last_name = additionalData.last_name || '';
    return address;
};

export const buildInitialStateLoginUser = (userData) => {
    let user = emptyLogin;
    if (userData) {
        user = userData;
    }
    // user.email = userData.email || '';
    // user.password = userData.password || '';
    return user;
};

/**
 * returns true, if the provided email is formatted correctly, else returns false
 * @param email
 * @returns {boolean}
 */
// eslint-disable-next-line no-useless-escape
export const validateEmail = (email) => (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email));

/**
 * Validates the shipping address fields
 *
 * @param address
 * @returns {{}} || {false}
 */
export const validator = (address) => {
    const errors = {};
    Object.keys(address).forEach((key) => {
        if (!controls[key]) { return; }
        if (controls[key].validationRules.notEmpty) {
            if (!address[key]) {
                errors[key] = `empty_${controls[key].type}`;
            }
        } else if (controls[key].validationRules.email) {
            if (!validateEmail(address[key])) {
                errors[key] = 'The provided email address is invalid';
            }
        }
    });
    return Object.keys(errors).length === 0 ? false : errors;
};

/**
 * formats the price into correct form
 * @param price
 * @param currency
 * @returns {string}
 */
export const formatPrice = (price, currency) => {
    const formatter = new Intl.NumberFormat('de-DE', {
        style: 'currency',
        currency: currency
    });
    return formatter.format(price);
};
