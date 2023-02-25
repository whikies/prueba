import React from 'react';
// @ts-ignore
import style from './Form.module.scss';

interface Props extends React.SelectHTMLAttributes<HTMLSelectElement> {

}

const Select = React.forwardRef((props: Props, ref: React.LegacyRef<HTMLSelectElement> | undefined) => {
    const { className='' } = props;

    return (
        <select
            { ...props }
            className={ [style.formControl, className].join(' ') }
            ref={ ref }
        >{ props.children }</select>
    )
});

Select.displayName = 'Select';

export default Select
