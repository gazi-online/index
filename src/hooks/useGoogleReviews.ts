import { useState } from 'react';
import GOOGLE_CONFIG, { GoogleReview, PlaceDetails } from '../config/googleConfig';

interface UseGoogleReviewsResult {
    reviews: GoogleReview[];
    placeData: PlaceDetails | null;
    loading: boolean;
    error: string | null;
    isLive: boolean;
}

export function useGoogleReviews(): UseGoogleReviewsResult {
    const [reviews] = useState<GoogleReview[]>(GOOGLE_CONFIG.STATIC_REVIEWS);
    const [placeData] = useState<PlaceDetails>(GOOGLE_CONFIG.PLACE_DATA);

    // Always static now
    return {
        reviews,
        placeData,
        loading: false,
        error: null,
        isLive: false
    };
}

export type { GoogleReview, PlaceDetails };
