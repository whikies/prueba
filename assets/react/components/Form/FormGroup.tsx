import React from 'react';
// @ts-ignore
import style from './Form.module.scss';

interface Props {
    children: React.ReactChild|React.ReactChild[];
    className?: string;
}

const FormGroup = ({ children, className }: Props) => {
    return (
        <div className={ [style.formGroup, className].join(' ') }>
            { children }
        </div>
    )
}

export default FormGroup
