import React from 'react';
// @ts-ignore
import style from './Form.module.scss';

interface Props extends React.LabelHTMLAttributes<HTMLLabelElement>
{

}

const Label = ({ children }: Props) => {
    return (
        <label className={ style.formLabel }>{ children }</label>
    )
}

export default Label;
