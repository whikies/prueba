import { hot } from 'react-hot-loader/root';
import React from 'react';
import { ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import MathOperations from '../components/MathOperations/MathOperations';

const Operation = () => {
    return (
        <>
            <ToastContainer position="top-center" hideProgressBar theme="colored" />
            <MathOperations />
        </>
    );
}

export default hot(Operation);
