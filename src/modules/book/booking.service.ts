// src/modules/booking/booking.service.ts
import { Injectable } from '@nestjs/common';

export interface Booking {
  id: number;
  start_date: string;
  end_date: string;
  hotel_id: number;
  is_checked_in: boolean;
  price: number;
}

@Injectable()
export class BookingService {
  private bookings: Booking[] = [];
  private idCounter = 1;

  create(hotel_id: number, start_date: string, end_date: string, price: number): Booking {
    const booking: Booking = {
      id: this.idCounter++,
      hotel_id,
      start_date,
      end_date,
      price,
      is_checked_in: false,
    };
    this.bookings.push(booking);
    return booking;
  }

  findAll(startDate: string, endDate: string): Booking[] {
    return this.bookings.filter(
      (b) =>
        new Date(b.start_date) >= new Date(startDate) &&
        new Date(b.end_date) <= new Date(endDate) &&
        new Date(b.start_date) <= new Date(b.end_date),
    );
  }

  cancel(id: number): Booking {
    const index = this.bookings.findIndex((b) => b.id === id);
    if (index === -1) throw new Error(`Booking with ID ${id} not found`);
    const [booking] = this.bookings.splice(index, 1);
    return booking;
  }

  checkIn(id: number): Booking {
    const booking = this.bookings.find((b) => b.id === id);
    if (!booking) throw new Error(`Booking with ID ${id} not found`);
    booking.is_checked_in = true;
    return booking;
  }
}