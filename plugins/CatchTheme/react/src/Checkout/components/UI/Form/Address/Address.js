import React, {useState} from 'react';
import {useTranslation} from 'react-i18next';
import TextInput from '../Input/TextInput/TextInput';
import SelectInput from '../Input/SelectInput/SelectInput';
import {controls} from '../../../../redux/utility';
import arrowDown from '../../../../assets/arrowDown.svg';
import arrowUp from '../../../../assets/arrowUp.svg';

const Address = ({errors, changeHandler, address, fetchingZipCodeData}) => {
    const inputs = [];
    const moreInputs = [];
    const {t} = useTranslation(['form', 'error']);
    Object.keys(controls).forEach((control) => {
        let className;
        if (controls[control].type && controls[control].type === 'select') {
            if (controls[control].name === 'country') {
                moreInputs.push(
                    <SelectInput
                        key={control}
                        name={controls[control].name}
                        onChange={(event) => {
                            changeHandler(control, event);
                        }}
                        value={address[control]}
                        options={controls[control].options || {}}
                        placeholder={t(`address.${controls[control].name}`)}
                        error={errors[control] || null}
                        disabled={controls[control].disabled || false}
                    />
                );
            } else {
                inputs.push(
                    <SelectInput
                        key={control}
                        name={controls[control].name}
                        onChange={(event) => {
                            changeHandler(control, event);
                        }}
                        value={address[control]}
                        options={controls[control].options || {}}
                        placeholder={t(`address.${controls[control].name}`)}
                        error={errors[control] || null}
                        disabled={controls[control].disabled || false}
                    />
                );
            }
        } else {
            let hasLoader = false;
            if (controls[control].name === 'state_or_province' || controls[control].name === 'city') {
                hasLoader = true;
                if (fetchingZipCodeData && address[control] === '') {
                    className = 'animated';
                }
            }
            if (
                controls[control].name === 'company'
                || controls[control].name === 'address_line_2'
                || controls[control].name === 'state_or_province'
                || controls[control].name === 'phone_number'
            ) {
                moreInputs.push(
                    <TextInput
                        key={control}
                        name={controls[control].name}
                        onChange={(event) => {
                            changeHandler(control, event);
                        }}
                        className={className}
                        hasLoader={hasLoader}
                        value={address[control]}
                        placeholder={t(`address.${controls[control].name}`)}
                        error={t(errors[control], {field: control}) || null}
                    />
                );
            } else {
                inputs.push(
                    <TextInput
                        key={control}
                        name={controls[control].name}
                        onChange={(event) => {
                            changeHandler(control, event);
                        }}
                        className={className}
                        hasLoader={hasLoader}
                        value={address[control]}
                        placeholder={`${t(`address.${controls[control].name}`)}`}
                        error={t(errors[control], {field: control}) || null}
                        required="required"
                        autoFocus={(controls[control].name === 'email')}
                    />
                );
            }
        }
    });
    const [moreInputFields, setMoreInputFields] = useState({
        show: false
    });
    const moreFieldsHandler = () => {
        setMoreInputFields({
            show: !moreInputFields.show
        });
    };
    const moreInputsContainer = (moreInputFields.show ? moreInputs : null);
    const moreArrow = (moreInputFields.show ? <img src={arrowUp}/> : <img src={arrowDown}/>);
    return (
        <div className="address">
            {inputs}
            <div className="more-inputs-wrapper">
                <div className="text-wrapper">
                    <div className="more-link">
                        {moreArrow}
                        <span onClick={moreFieldsHandler}>
                            {t(moreInputFields.show ? `address.show_less` : `address.show_more`)}
                        </span>
                    </div>
                    <div className="legend">
                        <span className="red">*</span>
                        <span> = {t(`address.legend`)}</span>
                    </div>
                </div>
                {moreInputsContainer}
            </div>
        </div>
    );
};

export default Address;
