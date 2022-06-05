import React from 'react';

import './Breadcrumbs.scss';

const Breadcrumbs = ({breadcrumbs, itemTitle}) => {
    const breadcrumbsJS = breadcrumbs.map((breadcrumb) => <a href={breadcrumb.url} key={breadcrumb.name}>{breadcrumb.name}</a>);
    return (
        <div className="breadcrumb-wrapper">
            {breadcrumbsJS}
            <span className="short-title">{itemTitle}</span>
        </div>
    );
};

export default Breadcrumbs;
