// Firebase utilities for PeaceHub
// This file provides helper functions for Firebase operations

class PeaceHubFirebase {
    constructor() {
        this.isInitialized = false;
        this.db = null;
    }

    // Initialize Firebase (call this first)
    async initialize() {
        try {
            // Wait for Firebase to be available
            if (!window.firebase) {
                throw new Error('Firebase not loaded');
            }
            
            this.db = window.firebase.db;
            this.isInitialized = true;
            console.log('PeaceHub Firebase initialized successfully');
        } catch (error) {
            console.error('Failed to initialize Firebase:', error);
            throw error;
        }
    }

    // Save a booking to Firestore
    async saveBooking(bookingData) {
        if (!this.isInitialized) {
            throw new Error('Firebase not initialized. Call initialize() first.');
        }

        try {
            // Add metadata to booking
            const dataWithMetadata = {
                ...bookingData,
                createdAt: window.firebase.serverTimestamp(),
                status: 'pending',
                source: 'web'
            };

            // Save to 'bookings' collection
            const docRef = await window.firebase.addDoc(
                window.firebase.collection(this.db, 'bookings'),
                dataWithMetadata
            );

            console.log('Booking saved successfully with ID:', docRef.id);
            return docRef.id;
        } catch (error) {
            console.error('Error saving booking:', error);
            throw error;
        }
    }

    // Save user feedback or contact form data
    async saveFeedback(feedbackData) {
        if (!this.isInitialized) {
            throw new Error('Firebase not initialized. Call initialize() first.');
        }

        try {
            const dataWithMetadata = {
                ...feedbackData,
                createdAt: window.firebase.serverTimestamp(),
                type: 'feedback'
            };

            const docRef = await window.firebase.addDoc(
                window.firebase.collection(this.db, 'feedback'),
                dataWithMetadata
            );

            console.log('Feedback saved successfully with ID:', docRef.id);
            return docRef.id;
        } catch (error) {
            console.error('Error saving feedback:', error);
            throw error;
        }
    }

    // Save newsletter subscription
    async saveNewsletterSubscription(email) {
        if (!this.isInitialized) {
            throw new Error('Firebase not initialized. Call initialize() first.');
        }

        try {
            const subscriptionData = {
                email: email,
                createdAt: window.firebase.serverTimestamp(),
                status: 'active'
            };

            const docRef = await window.firebase.addDoc(
                window.firebase.collection(this.db, 'newsletter_subscriptions'),
                subscriptionData
            );

            console.log('Newsletter subscription saved with ID:', docRef.id);
            return docRef.id;
        } catch (error) {
            console.error('Error saving newsletter subscription:', error);
            throw error;
        }
    }
}

// Create global instance
window.PeaceHubFirebase = new PeaceHubFirebase();