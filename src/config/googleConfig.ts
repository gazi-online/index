// ================================================
// Google Reviews Configuration (Static)
// ================================================

export interface GoogleReview {
    author_name: string;
    author_url?: string;
    profile_photo_url?: string;
    rating: number;
    relative_time_description: string;
    text: string;
    time: number;
}

export interface PlaceDetails {
    name: string;
    rating: number;
    user_ratings_total: number;
}

const GOOGLE_CONFIG = {
    // Static reviews to display
    STATIC_REVIEWS: [
        {
            author_name: 'Md. Rafiqul Islam',
            rating: 5,
            relative_time_description: '2 days ago',
            text: 'Excellent service! Got my bank account opened within 30 minutes. Very professional and helpful staff. Highly recommended!',
            time: 0,
            profile_photo_url: undefined,
        },
        {
            author_name: 'Priya Sharma',
            rating: 5,
            relative_time_description: '1 week ago',
            text: "I've been paying my electricity bills here for 2 years. Super fast, no queue, and the team is always friendly. Best digital center nearby!",
            time: 0,
            profile_photo_url: undefined,
        },
        {
            author_name: 'Suresh Kumar',
            rating: 5,
            relative_time_description: '3 weeks ago',
            text: 'Got my AEPS cash withdrawal done instantly. The staff explained the whole process very clearly. Will definitely come back for more services.',
            time: 0,
            profile_photo_url: undefined,
        },
        {
            author_name: 'Fatima Begum',
            rating: 5,
            relative_time_description: '1 month ago',
            text: 'Enrolled in PM Jeevan Jyoti insurance and got my Aadhaar updated here in one visit. Amazing service, truly one-stop center!',
            time: 0,
            profile_photo_url: undefined,
        },
    ] as GoogleReview[],

    // Overall data
    PLACE_DATA: {
        name: 'Gazi Online',
        rating: 4.9,
        user_ratings_total: 215,
    }
};

export default GOOGLE_CONFIG;
