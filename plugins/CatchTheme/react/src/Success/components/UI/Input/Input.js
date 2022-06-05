import React, { Component } from 'react';
import { withTranslation } from 'react-i18next';

import './Input.scss';

class Input extends Component {
    constructor(props) {
        super(props);
        this.onFocus = this.onFocus.bind(this);
        this.onBlur = this.onBlur.bind(this);
        this.state = {
            isFocused: false
        };
    }

    onFocus() {
        this.setState({isFocused: true});
    }

    onBlur() {
        this.setState({isFocused: false});
    }

    render() {
        const {
            t, placeholder, onChange, value, error, className
        } = this.props;
        const {isFocused} = this.state;
        const errorJSX = error ? <p className="error">{t(error)}</p> : '';
        return (
            <div className="input-wrapper">
                <input
                    placeholder={placeholder}
                    onFocus={this.onFocus}
                    onBlur={this.onBlur}
                    onChange={(e) => onChange(e)}
                    value={value}
                    className={className}
                />
                <div className={`input-underline${isFocused ? ' gradient' : ''}`}/>
                {errorJSX}
            </div>
        );
    }
}

export default withTranslation('error')(Input);
