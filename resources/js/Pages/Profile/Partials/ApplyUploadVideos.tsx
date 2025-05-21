import PrimaryButton from '@/Components/PrimaryButton';
import { usePage } from '@inertiajs/react';
import axios from 'axios';
import React, { useState } from 'react';

const ApplyUploadVideos = () => {
    const approve = usePage().props.auth.approve;
    const [approved, setApproved] = useState(approve);

    const renderApproveStatus = () => {
        switch (approved) {
            case 'ACCEPT':
                return (
                    <div className="flex items-center gap-2 font-semibold text-green-600">
                        <span className="inline-block h-3 w-3 rounded-full bg-green-500" />
                        Approved
                    </div>
                );
            case 'REJECT':
                return (
                    <div className="flex items-center gap-2 font-semibold text-red-600">
                        <span className="inline-block h-3 w-3 rounded-full bg-red-500" />
                        Rejected
                    </div>
                );
            case 'PENDING':
                return (
                    <div className="flex items-center gap-2 font-semibold text-yellow-600">
                        <span className="inline-block h-3 w-3 rounded-full bg-yellow-500" />
                        Pending Approval
                    </div>
                );
            default:
                return null;
        }
    };

    const handleClick = (e: React.MouseEvent<HTMLButtonElement>) => {
        e.preventDefault();

        axios
            .post(route('applyUpload'))
            .then((res) => {
                setApproved(res.data.approve);
            })
            .catch((error) => console.log(error));
    };

    return (
        <section>
            <header>
                <h2 className="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Apply To Upload Movies
                </h2>

                <p className="mb-4 mt-1 text-sm text-gray-600 dark:text-gray-400">
                    To upload movies, you need to apply and wait for approval.
                </p>

                {/* Show current approval status */}
                {renderApproveStatus()}

                {/* Show Apply button only if not approved yet */}
                {!approved && (
                    <PrimaryButton onClick={handleClick} className="mt-4">
                        Apply
                    </PrimaryButton>
                )}
            </header>
        </section>
    );
};

export default ApplyUploadVideos;
