import React from 'react';
import { FaCircleNotch } from 'react-icons/fa';
// @ts-ignore
import styles from './Loader.module.scss';

interface Props {
    color?: string;
    size?: number;
    absolute?: boolean;
    className?: string;
    style?: React.CSSProperties | undefined
}

export const Loader = ({ color = '#bbbbbb', size = 20, absolute, className, style }: Props) => {
    return (
        <div className={ [styles.loader, className, absolute ? styles.absolute : ''].join(' ') } style={ style }>
            <FaCircleNotch
                color={ color }
                size={ size }
                style={{
                    animation: "fa-spin 2s infinite linear"
                }}
            />
        </div>
    )
}
