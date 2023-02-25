import React from 'react';
// @ts-ignore
import style from './Button.module.scss';

interface Props extends React.ButtonHTMLAttributes<HTMLButtonElement>
{
    typeBtn?: 'primary' | 'secondary' | 'success' | 'danger' | 'warning' | 'info' | 'light' | 'dark';
    size?: 'large' | 'small';
    outline?: boolean;
    full?: boolean;
}

const Button = (props: Props) => {
    const { className = '', outline, full, size, typeBtn = '', ...rest } = props;
    let sizeButton = '';

    switch (size) {
        case 'large':
            sizeButton = style.large;
            break;

        case 'small':
            sizeButton = style.small;
            break;

    }

    return (
        <button { ...{ ...rest,
            className: [style.btn, className, typeBtn ? (style[outline ? `outline-${typeBtn}` : typeBtn]) : '', full ? style.full : '', sizeButton ].join(' ')
        } }>{ props.children }</button>
    )
}

export default Button;
