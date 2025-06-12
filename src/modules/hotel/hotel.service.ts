// src/modules/hotel/hotel.service.ts
import { Injectable } from '@nestjs/common';

export interface Hotel {
  id: number;
  name: string;
  address: string;
  phone: string;
}

@Injectable()
export class HotelService {
  private hotels: Hotel[] = [];
  private idCounter = 1;

  create(name: string, address: string, phone: string): Hotel {
    const hotel: Hotel = {
      id: this.idCounter++,
      name,
      address,
      phone,
    };
    this.hotels.push(hotel);
    return hotel;
  }

  findAll(): Hotel[] {
    return this.hotels;
  }

  findOne(id: number): Hotel {
    const hotel = this.hotels.find((h) => h.id === id);
    if (!hotel) throw new Error(`Hotel with ID ${id} not found`);
    return hotel;
  }

  update(id: number, name?: string, address?: string, phone?: string): Hotel {
    const hotel = this.findOne(id);
    if (name) hotel.name = name;
    if (address) hotel.address = address;
    if (phone) hotel.phone = phone;
    return hotel;
  }

  remove(id: number): Hotel {
    const index = this.hotels.findIndex((h) => h.id === id);
    if (index === -1) throw new Error(`Hotel with ID ${id} not found`);
    const [hotel] = this.hotels.splice(index, 1);
    return hotel;
  }
}