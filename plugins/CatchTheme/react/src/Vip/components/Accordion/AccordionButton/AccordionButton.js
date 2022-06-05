import React, {useState} from 'react';
import Button from '../../Button/Button';
import open from '../../../assets/accordion-open.svg';
import close from '../../../assets/accordion-close.svg';

import './AccordionButton.scss';

const AccordionButton = (props) => {
    const {
        className,
        content,
        text
    } = props;

    const [selectedState, setSelectedState] = useState({
        selected: false
    });

    const toggleAccordion = () => {
        if (selectedState.selected) {
            setSelectedState({
                selected: false
            });
        } else {
            setSelectedState({
                selected: true
            });
        }
    };
    let accordionContent = selectedState.selected ? content : null;

    return (
        <div className="accordion-button-wrapper">
            <Button
                text={text}
                onClick={toggleAccordion}
                className={[className, selectedState.selected ? " selected" : ""].join('')}
                >
                <img src={selectedState.selected ? close : open}/>
            </Button>
            {accordionContent}
        </div>
    );
};

export default AccordionButton;
