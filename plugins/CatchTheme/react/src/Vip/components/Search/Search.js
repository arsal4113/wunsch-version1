import React from 'react';
import searchIcon from '../../assets/search-icon.svg';
import './Search.scss';

const Search = () => {

    let content = null;
    const searchClickHandler = () => {
        content = (<input id="searchfield" />)
    };
    content = (<img src={searchIcon} onClick={searchClickHandler}/>);
    return (
        <div className="search">
            {content}
        </div>
    );
};

export default Search;
