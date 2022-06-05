import React from 'react';

import './Attributes.scss';

const Attributes = (props) => {
    const {item} = props;
    const tabContent = [];

    if (item.attributes) {
        item.attributes.map((attribute) => {
            return (
              tabContent.push(
                  <dl key={attribute.name}>
                      <dt>
                          {attribute.name}
                          :
                      </dt>
                      {' '}
                      <dd>{attribute.value}</dd>
                  </dl>
              )
            );
        });
    }

    return (
        <div className="tab-content attributes">
            {tabContent}
        </div>
    );
};

export default Attributes;
