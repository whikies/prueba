import React from 'react';
// @ts-ignore
import style from './Form.module.scss';

interface Props extends React.InputHTMLAttributes<HTMLInputElement> {

}

const Input = React.forwardRef((props: Props, ref: React.LegacyRef<HTMLInputElement> | undefined) => {
    const { className='' } = props;

    return (
        <input
            { ...props }
            className={ [style.formControl, className].join(' ') }
            ref={ ref }
        />
    )
});

Input.displayName = 'Input';

export default Input
